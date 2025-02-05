<?php

declare(strict_types=1);

namespace Hexlet\Validator\Schemas;

class NumberSchema extends Schema
{
    public function required(): static
    {
        $this->rules['required'] = fn($value) => is_int($value) && $value !== 0;
        return $this;
    }

    public function positive(): static
    {
        $this->rules['positive'] = fn($value) => (int)$value >= 0;
        return $this;
    }

    public function range(int $from, int $to): static
    {
        $this->rules['range'] = fn($value) => (int)$value >= $from && (int)$value <= $to;
        return $this;
    }

    /**
     * @param ?int $content
     * @return bool
     */
    public function isValid(?int $content = null): bool
    {
        $handler = $this->verification::getVerifyHandler();
        return $handler($this->rules, $content);
    }
}
