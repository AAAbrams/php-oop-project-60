<?php

declare(strict_types=1);

namespace Alligator\Interfaces;

interface StringSchemaInterface extends SchemaInterface
{
    public function minLength(int $length): static;

    public function contains(string $subject): static;
}
