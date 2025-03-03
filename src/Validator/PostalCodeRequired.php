<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class PostalCodeRequired extends Constraint
{
    public string $message = 'Postal code is required.';
}
