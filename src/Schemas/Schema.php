<?php

declare(strict_types=1);

namespace Hexlet\Validator\Schemas;

use Hexlet\Validator\Interfaces\VerificationInterface;
use Hexlet\Validator\Support\SchemaRuleExtension;
use Hexlet\Validator\Verifications\DefaultVerification;
use Closure;
use RuntimeException;

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

    public function __construct(
        protected array $macroRules = []
    ) {
        $this->verification = DefaultVerification::class;
    }

    /**
     * @param string $ruleName
     * @param mixed $value
     * @return SchemaRuleExtension
     * @throws RuntimeException
     */
    public function test(string $ruleName, mixed $value): SchemaRuleExtension
    {
        if (isset($this->macroRules[$ruleName]) && $this->macroRules[$ruleName] instanceof Closure) {
            return new SchemaRuleExtension($this->macroRules[$ruleName], $value);
        }
        throw new RuntimeException("There is no rule with name '$ruleName'");
    }
}
