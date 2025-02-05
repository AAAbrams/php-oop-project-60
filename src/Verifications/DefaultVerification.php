<?php

declare(strict_types=1);

namespace Hexlet\Validator\Verifications;

use Hexlet\Validator\Interfaces\VerificationInterface;
use Closure;

class DefaultVerification implements VerificationInterface
{
    public static function getVerifyHandler(): Closure
    {
        return function ($rules, $content): bool {
            $test = array_filter($rules, fn(callable $rule) => !$rule($content));
            return count($test) === 0;
        };
    }
}
