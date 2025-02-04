<?php

declare(strict_types=1);

namespace Alligator\Interfaces;

interface NumberSchemaInterface extends SchemaInterface
{
    public function positive(): static;

    public function range(int $from, int $to): static;
}
