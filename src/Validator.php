<?php

declare(strict_types=1);

namespace Alligator;

use Alligator\Interfaces\ArraySchemaInterface;
use Alligator\Interfaces\NumberSchemaInterface;
use Alligator\Interfaces\StringSchemaInterface;
use Alligator\Schemas\ArraySchema;
use Alligator\Schemas\NumberSchema;
use Alligator\Schemas\StringSchema;

class Validator
{
    public function string(): StringSchemaInterface
    {
        return new StringSchema();
    }

    public function number(): NumberSchemaInterface
    {
        return new NumberSchema();
    }

    public function array(): ArraySchemaInterface
    {
        return new ArraySchema();
    }
}
