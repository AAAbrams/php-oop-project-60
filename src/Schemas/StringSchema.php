<?php

declare(strict_types=1);

namespace Alligator\Schemas;

class StringSchema extends Schema
{
    public function required(): static
    {
        $this->rules['required'] = fn(string $value): bool => !empty($value);
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
    public function isValid(mixed $content = null): bool
    {
        return parent::isValid((string)$content);
    }
}
