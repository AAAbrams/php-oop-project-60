<?php

declare(strict_types=1);

namespace Alligator\Schemas;

use Alligator\Interfaces\VerificationInterface;
use Alligator\Verifications\DefaultVerification;

abstract class Schema
{
    /**
     * @var array<string, callable|Schema>
     */
    protected array $rules = [];

    /**
     * @template T of VerificationInterface
     * @var class-string<T>
     */
    protected string $verification;

    public function __construct()
    {
        $this->verification = DefaultVerification::class;
    }
}
