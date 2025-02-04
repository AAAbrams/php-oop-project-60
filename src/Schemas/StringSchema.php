<?php

declare(strict_types=1);

namespace Alligator\Schemas;

class StringSchema implements SchemaInterface
{
    /**
     * @var array<callable>
     */
    private array $rules = [];

    public function required(): static
    {
        $this->rules['req'] = fn(string $value): bool => !empty($value);
        return $this;
    }

    public function minLength(int $length): static
    {
        $this->rules['ml'] = fn(string $value): bool => mb_strlen($value) >= $length;
        return $this;
    }

    public function contains(string $subject): static
    {
        $this->rules['cont'] = fn(string $value): bool => stripos($value, $subject) !== false;
        return $this;
    }

    public function isValid(?string $content = null): bool
    {
        $value = $content ?? '';

        $test = array_filter($this->rules, fn(callable $rule) => !$rule($value));

        return empty($test);
    }
}
