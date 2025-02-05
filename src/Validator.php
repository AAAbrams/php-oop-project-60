<?php

declare(strict_types=1);

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\ArraySchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;
use Hexlet\Validator\Support\SchemaRuleDispatcher;
use Closure;

class Validator
{
    private SchemaRuleDispatcher $ruleDispatcher;
    public function __construct()
    {
        $this->ruleDispatcher = new SchemaRuleDispatcher();
    }

    /**
     * @return StringSchema
     */
    public function string(): StringSchema
    {
        return $this->ruleDispatcher->createSchema(StringSchema::class);
    }

    public function number(): NumberSchema
    {
        return $this->ruleDispatcher->createSchema(NumberSchema::class);
    }

    public function array(): ArraySchema
    {
        return $this->ruleDispatcher->createSchema(ArraySchema::class);
    }

    public function addValidator(string $type, string $name, Closure $rule): void
    {
        $this->ruleDispatcher->registerSchemaRule($type, $name, $rule);
    }
}
