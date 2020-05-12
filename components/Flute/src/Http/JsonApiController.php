<?php declare (strict_types=1);

namespace Limoncello\Flute\Http;

use Limoncello\Flute\Contracts\Http\RouteKeyIndex\RouteKeyIndexInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @package App
 */
abstract class JsonApiController extends JsonApiBaseController
{
    /**
     * @inheritDoc
     */
    public static function update(
        array $routeParams,
        ContainerInterface $container,
        ServerRequestInterface $request
    ): ResponseInterface
    {
        /** @var RouteKeyIndexInterface $routeKeyIndex */
        $routeKeyIndex = $container->get(RouteKeyIndexInterface::class);
        $routeKeyIndex->setValue($routeParams[static::ROUTE_KEY_INDEX]);

        return parent::update($routeParams, $container, $request);
    }
}
