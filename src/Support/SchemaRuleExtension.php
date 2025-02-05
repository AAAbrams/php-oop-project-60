<?php

declare(strict_types=1);

namespace Hexlet\Validator\Support;

readonly class SchemaRuleExtension
{
    public function __construct(
        private \Closure $rule,
        private mixed $value
    ) {
    }

    public function isValid(mixed $content): bool
    {
        return ($this->rule)($content, $this->value);
    }
}
