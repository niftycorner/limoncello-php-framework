<?php declare (strict_types = 1);

namespace Limoncello\Flute\Types;

/**
 * Copyright 2015-2019 info@neomerx.com
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

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use JsonSerializable;

/**
 * Wrapper class for `DateTimeInterface` value with JSON serialization support.
 *
 * @package Limoncello\Flute
 */
class DateTime extends DateTimeImmutable implements JsonSerializable
{
    /** DateTime format */
    const JSON_API_FORMAT = \DateTime::ISO8601;

    /**
     * @param DateTimeInterface $dateTime
     *
     * @return DateTime
     *
     * @throws Exception
     */
    public static function createFromDateTime(DateTimeInterface $dateTime): self
    {
        $utcTimestamp = $dateTime->getTimestamp();

        // yes, PHP DateTime can accept integer timestamp only as a string ¯\_( ͡° ͜ʖ ͡°)_/¯
        $result = (new self("@$utcTimestamp"))->setTimezone($dateTime->getTimezone());

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->format(static::JSON_API_FORMAT);
    }
}
