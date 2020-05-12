<?php declare(strict_types=1);

namespace Limoncello\Flute\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @package App
 */
class UuidType extends GuidType
{
    /**
     * Type name
     */
    const NAME = 'limoncelloUuid';

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        $result = null;

        if (empty($value))
            $result = null;

        if (($value instanceof UuidInterface) || ((is_string($value) || method_exists($value, '__toString')) && Uuid::isValid((string)$value)))
            $result = (string)$value;

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?UuidInterface
    {
        $result = null;

        if (empty($value)) {
            $result = null;
        }

        if ($value instanceof UuidInterface) {
            $result = $value;
        }

        if (is_string($value)) {
            $result = Uuid::fromString($value);
        }

        return $result;
    }
}
