<?php

declare(strict_types=1);

namespace Hexlet\Validator\Verifications;

use Hexlet\Validator\Interfaces\VerificationInterface;
use Closure;

class ArrayShapeVerification implements VerificationInterface
{
    public static function getVerifyHandler(): Closure
    {
        return function ($rules, $content): bool {
            if (count($rules) === 0) {
                return true;
            }

            $test = array_filter(
                $rules,
                fn($schema, $name) => !$schema->isValid($content[$name]),
                ARRAY_FILTER_USE_BOTH
            );

            return count($test) === 0;
        };
    }
}
