<?php

declare(strict_types=1);

namespace Hexlet\Validator\Interfaces;

use Closure;

interface VerificationInterface
{
    public static function getVerifyHandler(): Closure;
}
