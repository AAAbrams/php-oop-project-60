<?php

declare(strict_types=1);

namespace Alligator\Interfaces;

use Closure;

interface VerificationInterface
{
    public static function getVerifyHandler(): Closure;
}
