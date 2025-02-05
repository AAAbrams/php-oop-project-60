<?php

declare(strict_types=1);

namespace Hexlet\Validator\Schemas;

class StringSchema extends Schema
{
    public function required(): static
    {
        $this->rules['required'] = fn(string $value): bool => mb_strlen($value) !== 0;
        return $this;
    }

    public function minLength(int $length): static
    {
        $this->rules['min_length'] = fn(string $value): bool => mb_strlen($value) >= $length;
        return $this;
    }

    public function contains(string $subject): static
    {
        $this->rules['contains'] = fn(string $value): bool => stripos($value, $subject) !== false;
        return $this;
    }

    /**
     * @param ?string $content
     * @return bool
     */
    public function isValid(?string $content = null): bool
    {
        $handler = $this->verification::getVerifyHandler();
        return $handler($this->rules, (string)$content);
        //return parent::isValid((string)$content);
    }
}
