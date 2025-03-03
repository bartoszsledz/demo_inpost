<?php

namespace App\Enum;

use InvalidArgumentException;

enum Resource: string
{
    case Points = 'points';

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'points' => self::Points,
            default => throw new InvalidArgumentException(sprintf('Resource %s is not supported.', $value)),
        };
    }
}
