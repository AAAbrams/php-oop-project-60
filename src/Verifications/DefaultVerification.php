<?php

declare(strict_types=1);

namespace Alligator\Verifications;

use Alligator\Interfaces\VerificationInterface;
use Closure;

class DefaultVerification implements VerificationInterface
{
    public static function getVerifyHandler(): Closure
    {
        return function ($rules, $content): bool {
            $test = array_filter($rules, fn(callable $rule) => !$rule($content));
            return empty($test);
        };
    }
}
