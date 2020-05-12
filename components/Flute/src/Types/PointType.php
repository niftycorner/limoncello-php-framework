<?php declare (strict_types=1);

namespace Limoncello\Flute\Types;

/**
 * @package App
 */
class PointType extends \Brick\Geo\Doctrine\Types\PointType
{
    /**
     * Type name
     */
    const NAME = 'limoncelloPoint';
}
