<?php

declare(strict_types=1);

namespace Hexlet\Validator\Support;

use Hexlet\Validator\Schemas\Schema;
use Closure;

class SchemaRuleDispatcher
{
    /**
     * @var array<string, array<string, Closure>>
     */
    private array $mapping;

    /**
     * @template T of Schema
     * @param class-string<T> $type
     * @return T
     */
    public function createSchema(string $type): Schema
    {
        return new $type($this->mapping[$type] ?? []);
    }

    public function registerSchemaRule(string $type, string $name, Closure $fn): void
    {
        $className = SchemaRegistry::tryFrom($type)?->getClassName() ?? $type;
        $this->mapping[$className][$name] = $fn;
    }
}
