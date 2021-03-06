<?php declare(strict_types=1);

namespace Limoncello\Tests\Auth\Authorization\PolicyEnforcement\Data;

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

/**
 * @package Limoncello\Tests\Auth
 */
interface ContextProperties extends RequestProperties
{
    /** Context key */
    const CONTEXT_CURRENT_USER_ID = self::REQUEST_LAST + 1;

    /** Context key */
    const CONTEXT_CURRENT_USER_ROLE = self::CONTEXT_CURRENT_USER_ID + 1;

    /** Context key */
    const CONTEXT_IS_WORK_TIME = self::CONTEXT_CURRENT_USER_ROLE + 1;

    /** Context key */
    const CONTEXT_USER_IS_SIGNED_IN = self::CONTEXT_IS_WORK_TIME + 1;

    /** Context key */
    const CONTEXT_LAST = self::CONTEXT_USER_IS_SIGNED_IN;
}
