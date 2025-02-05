<?php

declare(strict_types=1);

namespace Alligator;

use Alligator\Schemas\ArraySchema;
use Alligator\Schemas\NumberSchema;
use Alligator\Schemas\StringSchema;
use Alligator\Support\SchemaRuleDispatcher;
use Closure;

class Validator
{
    private SchemaRuleDispatcher $ruleDispatcher;
    public function __construct()
    {
        $this->ruleDispatcher = new SchemaRuleDispatcher();
    }

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
