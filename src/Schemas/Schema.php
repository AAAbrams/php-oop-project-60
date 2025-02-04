<?php

declare(strict_types=1);

namespace Alligator\Schemas;

use Alligator\Interfaces\SchemaInterface;

abstract class Schema implements SchemaInterface
{
    /**
     * @var array<callable>
     */
    protected array $rules = [];

    public function isValid(mixed $content = null): bool
    {
        $test = array_filter($this->rules, fn(callable $rule) => !$rule($content));
        return empty($test);
    }
}
