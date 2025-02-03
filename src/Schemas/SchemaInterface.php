<?php

declare(strict_types=1);

namespace Alligator\Schemas;

interface SchemaInterface
{
    /**
     * @param list<string> $options
     */
    public function __construct(array $options = []);

    public function required(): static;

    public function minLength(int $length): static;

    public function contains(string $subject): static;

    public function isValid(?string $content): bool;
}
