<?php declare(strict_types=1);

namespace Limoncello\Application\Packages\Application;

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

use Limoncello\Application\ExceptionHandlers\WhoopsThrowableHtmlHandler;
use Limoncello\Application\ExceptionHandlers\WhoopsThrowableTextHandler;
use Limoncello\Contracts\Application\ContainerConfiguratorInterface;
use Limoncello\Contracts\Container\ContainerInterface as LimoncelloContainerInterface;
use Limoncello\Contracts\Exceptions\ThrowableHandlerInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;
use function php_sapi_name;

/**
 * @package Limoncello\Application
 */
class WhoopsContainerConfigurator implements ContainerConfiguratorInterface
{
    /** @var callable */
    const CONFIGURATOR = self::CONFIGURE_EXCEPTION_HANDLER;

    /** Configurator callable */
    const CONFIGURE_EXCEPTION_HANDLER = [self::class, self::CONTAINER_METHOD_NAME];

    /**
     * @inheritdoc
     */
    public static function configureContainer(LimoncelloContainerInterface $container): void
    {
        $container[ThrowableHandlerInterface::class] =
            function (PsrContainerInterface $container): ThrowableHandlerInterface {
                $isCli = php_sapi_name() === 'cli';

                return $isCli === true ? new WhoopsThrowableTextHandler() : new WhoopsThrowableHtmlHandler();
            };
    }
}
