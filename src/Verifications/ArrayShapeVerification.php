<?php

declare(strict_types=1);

namespace Alligator\Verifications;

use Alligator\Interfaces\VerificationInterface;
use Closure;

class ArrayShapeVerification implements VerificationInterface
{
    public static function getVerifyHandler(): Closure
    {
        return function ($rules, $content): bool {
            if (empty($rules)) {
                return true;
            }

            $test = array_filter(
                $rules,
                fn($schema, $name) => !$schema->isValid($content[$name]),
                ARRAY_FILTER_USE_BOTH
            );

            return empty($test);
        };
    }
}
