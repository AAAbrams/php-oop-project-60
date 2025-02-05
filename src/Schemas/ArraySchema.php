<?php

declare(strict_types=1);

namespace Hexlet\Validator\Schemas;

use Hexlet\Validator\Verifications\ArrayShapeVerification;

class ArraySchema extends Schema
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
     * @param array<string, Schema> $shapeRules
     * @return $this
     */
    public function shape(array $shapeRules): static
    {
        $this->verification = ArrayShapeVerification::class;
        $this->rules = $shapeRules;
        return $this;
    }

    /**
     * @param ?mixed[] $content
     * @return bool
     */
    public function isValid(?array $content = null): bool
    {
        $handler = $this->verification::getVerifyHandler();
        return $handler($this->rules, $content);
    }
}
