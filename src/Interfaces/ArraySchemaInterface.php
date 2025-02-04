<?php

declare(strict_types=1);

namespace Alligator\Interfaces;

interface ArraySchemaInterface extends SchemaInterface
{
    public function sizeof(int $size): static;
}