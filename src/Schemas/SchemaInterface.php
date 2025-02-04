<?php

declare(strict_types=1);

namespace Alligator\Schemas;

interface SchemaInterface
{
    public function required(): static;

    public function minLength(int $length): static;

    public function contains(string $subject): static;

    public function isValid(?string $content): bool;
}
