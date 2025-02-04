<?php

declare(strict_types=1);

namespace Alligator\Schemas;

use Alligator\Interfaces\NumberSchemaInterface;

class NumberSchema extends Schema implements NumberSchemaInterface
{
    public function required(): static
    {
        $this->rules['required'] = fn($value) => !is_null($value);
        return $this;
    }

    public function positive(): static
    {
        $this->rules['positive'] = fn($value) => (int)$value > 0;
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
    public function isValid(mixed $content = null): bool
    {
        $value = !is_null($content) ? (int)$content : null;
        return parent::isValid($value);
    }
}
