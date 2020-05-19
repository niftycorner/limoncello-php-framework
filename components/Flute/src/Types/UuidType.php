<?php declare(strict_types=1);

namespace Limoncello\Flute\Types;

/**
 * @package App
 */
class UuidType extends \Ramsey\Uuid\Doctrine\UuidType
{
    /**
     * Type name
     */
    const NAME = 'limoncelloUuid';
}
