<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PostalCodeRequiredValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        $formData = $this->context->getRoot()->getData();

        if (!empty($formData['street']) && empty($formData['postalCode'])) {
            $this->context->buildViolation($constraint->message)
                          ->atPath('postalCode')
                          ->addViolation();
        }
    }
}
