<?php

declare(strict_types=1);

namespace Alligator\Interfaces;

interface SchemaInterface
{
    public function required(): static;
    public function isValid(mixed $content = null): bool;
}
