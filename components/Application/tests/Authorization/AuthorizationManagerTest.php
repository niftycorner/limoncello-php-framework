<?php declare(strict_types=1);

namespace Limoncello\Tests\Application\Authorization;

/**
 * Copyright 2015-2020 info@neomerx.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use Limoncello\Application\Authorization\AuthorizationRulesTrait;
use Limoncello\Application\Authorization\ContextProperties;
use Limoncello\Application\Authorization\RequestProperties;
use Limoncello\Application\Exceptions\AuthorizationException;
use Limoncello\Application\Packages\Authorization\AuthorizationContainerConfigurator;
use Limoncello\Application\Packages\Authorization\AuthorizationSettings as C;
use Limoncello\Auth\Authorization\PolicyEnforcement\Request;
use Limoncello\Auth\Authorization\PolicyInformation\Context;
use Limoncello\Container\Container;
use Limoncello\Contracts\Authentication\AccountInterface;
use Limoncello\Contracts\Authentication\AccountManagerInterface;
use Limoncello\Contracts\Authorization\AuthorizationManagerInterface;
use Limoncello\Contracts\Exceptions\AuthorizationExceptionInterface;
use Limoncello\Contracts\Settings\SettingsProviderInterface;
use Limoncello\Tests\Application\Data\Authorization\NotificationRules;
use Limoncello\Tests\Application\Packages\Authorization\AuthorizationPackageTest;
use Limoncello\Tests\Application\TestCase;
use Mockery;
use Mockery\Mock;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ReflectionException;

/**
 * @package Limoncello\Tests\Application
 */
class AuthorizationManagerTest extends TestCase
{
    use AuthorizationRulesTrait;

    /**
     * Test wrappers for working with context.
     *
     * @return void
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testTraitWrappers(): void
    {
        $actionName       = 'some_action';
        $resType          = 'some_type';
        $resIdentity      = 'some_identity';
        $resAttributes    = ['attribute_name' => 'value'];
        $resRelationships = ['relationships_name1' => 'value1', 'relationships_name2' => ['value2', 'value3']];
        $container        = new Container();

        /** @var Mock $managerMock */
        $container[AccountManagerInterface::class] = $managerMock = Mockery::mock(AccountManagerInterface::class);
        $managerMock->shouldReceive('getAccount')->zeroOrMoreTimes()->withNoArgs()
            ->andReturn($curAccount = Mockery::mock(AccountInterface::class));

        $ctxDefinitions = [
            ContextProperties::CTX_CONTAINER => $container,
        ];
        $reqProperties  = [
            RequestProperties::REQ_ACTION            => $actionName,
            RequestProperties::REQ_RESOURCE_TYPE     => $resType,
            RequestProperties::REQ_RESOURCE_IDENTITY => $resIdentity,

            RequestProperties::REQ_RESOURCE_ATTRIBUTES    => $resAttributes,
            RequestProperties::REQ_RESOURCE_RELATIONSHIPS => $resRelationships,
        ];

        $context = new Context(new Request($reqProperties), $ctxDefinitions);

        $this->assertEquals($actionName, $this->reqGetAction($context));
        $this->assertEquals($resType, $this->reqGetResourceType($context));
        $this->assertEquals($resIdentity, $this->reqGetResourceIdentity($context));
        $this->assertEquals($resAttributes, $this->reqGetResourceAttributes($context));
        $this->assertEquals($resRelationships, $this->reqGetResourceRelationships($context));
        $this->assertEquals($container, $this->ctxGetContainer($context));
        $this->assertEquals($curAccount, $this->ctxGetCurrentAccount($context));
    }

    /**
     * Test authorization.
     *
     * @return void
     *
     * @throws AuthorizationExceptionInterface
     * @throws ReflectionException
     */
    public function testAuthorize(): void
    {
        $container = new Container();

        /** @var Mock $provider */
        $appSettings                                 = [];
        $container[SettingsProviderInterface::class] = $provider = Mockery::mock(SettingsProviderInterface::class);
        $container[LoggerInterface::class]           = new NullLogger();
        $provider->shouldReceive('get')->once()->with(C::class)
            ->andReturn(AuthorizationPackageTest::getAuthorizationSettings()->get($appSettings));

        AuthorizationContainerConfigurator::configureContainer($container);

        /** @var AuthorizationManagerInterface $manager */
        $this->assertNotNull($manager = $container->get(AuthorizationManagerInterface::class));

        $gotException = false;
        $actionName   = 'some_non_existing_action';
        try {
            $manager->authorize($actionName);
        } catch (AuthorizationException $exception) {
            $gotException = true;
            $this->assertEquals($actionName, $exception->getAction());
            $this->assertEmpty($exception->getResourceType());
            $this->assertEmpty($exception->getResourceIdentity());
            $this->assertEmpty($exception->getExtraParameters());
        }
        $this->assertTrue($gotException);

        // this one pass check and not throw auth exception
        $manager->authorize(NotificationRules::ACTION_CAN_SEND_PERSONAL_EMAILS);
    }
}
