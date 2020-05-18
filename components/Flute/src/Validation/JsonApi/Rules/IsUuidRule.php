<?php declare(strict_types=1);

namespace Limoncello\Flute\Validation\JsonApi\Rules;

use Limoncello\Flute\Contracts\Validation\ErrorCodes;
use Limoncello\Flute\L10n\Messages;
use Limoncello\Validation\Contracts\Execution\ContextInterface;
use Limoncello\Validation\Rules\ExecuteRule;
use Ramsey\Uuid\Validator\ValidatorInterface as UuidValidatorInterface;

/**
 * @package App
 */
final class IsUuidRule extends ExecuteRule
{
    /**
     * @inheritDoc
     */
    public static function execute($value, ContextInterface $context): array
    {
        /** @var UuidValidatorInterface $uuidValidator */
        $uuidValidator = $context->getContainer()->get(UuidValidatorInterface::class);

        return $uuidValidator->validate($value) === true ?
            static::createSuccessReply($value) :
            static::createErrorReply(
                $context,
                $value,
                ErrorCodes::INVALID_UUID,
                Messages::INVALID_UUID,
                []
            );
    }
}
