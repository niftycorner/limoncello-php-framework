<?php declare (strict_types=1);

namespace Limoncello\Flute\Http\RouteKeyIndex;

use Limoncello\Container\Traits\HasContainerTrait;
use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * @package App
 */
class RouteKeyIndex
{
    use HasContainerTrait;

    /**
     * @inheritDoc
     */
    public function __construct(PsrContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @var
     */
    private $value;

    /**
     * @inheritDoc
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function setValue(string $value): void
    {
        $this->setValue($value);
    }
}
