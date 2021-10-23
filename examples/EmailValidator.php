<?php

namespace Jean\GraphqlInputs\examples;

use Attribute;
use Spatie\DataTransferObject\Validation\ValidationResult;
use Spatie\DataTransferObject\Validator;

#[Attribute()]
class EmailValidator implements Validator
{
    public function validate(mixed $value): ValidationResult
    {
        if (empty($value) || ! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return ValidationResult::invalid(sprintf(
                'email validation failled for: %s',
                $value
            ));
        }

        return ValidationResult::valid();
    }
}

