<?php declare (strict_types=1);

namespace Limoncello\Flute\Types;

/**
 * @package App
 */
class GeometryCollectionType extends \Brick\Geo\Doctrine\Types\GeometryCollectionType
{
    /**
     * Type name
     */
    const NAME = 'limoncelloGeometryCollection';
}
