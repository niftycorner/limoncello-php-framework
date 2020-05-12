<?php declare (strict_types=1);

namespace Limoncello\Flute\Contracts\Http\RouteKeyIndex;

/**
 * @package Limoncello\Flute
 */
interface RouteKeyIndexInterface
{
    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param string $value
     */
    public function setValue(string $value): void;
}
