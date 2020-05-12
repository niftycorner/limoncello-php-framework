<?php declare (strict_types=1);

namespace Limoncello\Flute\Types;

/**
 * @package App
 */
class MultiPointType extends \Brick\Geo\Doctrine\Types\MultiPointType
{
    /**
     * Type name
     */
    const NAME = 'limoncelloMultiPoint';
}
