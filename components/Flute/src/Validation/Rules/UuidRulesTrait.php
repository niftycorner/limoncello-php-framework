<?php declare(strict_types=1);

namespace Limoncello\Flute\Validation\Rules;

use Limoncello\Flute\Validation\JsonApi\Rules\IsUuidRule;
use Limoncello\Validation\Contracts\Rules\RuleInterface;
use Limoncello\Validation\Rules\Generic\AndOperator;

/**
 * @package Limoncello\Flute
 */
trait UuidRulesTrait
{
    /**
     * @param RuleInterface|null $next
     *
     * @return RuleInterface
     */
    protected static function isUuid(RuleInterface $next = null): RuleInterface
    {
        $primary = new IsUuidRule();

        return $next === null ? $primary : new AndOperator($primary, $next);
    }
}
