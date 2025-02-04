<?php

declare(strict_types=1);

namespace Alligator\Schemas;

use Alligator\Interfaces\ArraySchemaInterface;

class ArraySchema extends Schema implements ArraySchemaInterface
{

    public function required(): static
    {
        $this->rules['required'] = fn($value) => is_array($value);
        return $this;
    }

    public function sizeof(int $size): static
    {
        $this->rules['sizeof'] = fn($value) => count($value) === $size;
        return $this;
    }

    /**
     * @param ?array $content
     * @return bool
     */
    public function isValid(mixed $content = null): bool
    {
        $value = is_array($content) ? $content : null;
        return parent::isValid($value);
    }

}