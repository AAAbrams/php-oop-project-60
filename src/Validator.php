<?php

declare(strict_types=1);

namespace Alligator;

use Alligator\Schemas\ArraySchema;
use Alligator\Schemas\NumberSchema;
use Alligator\Schemas\StringSchema;

class Validator
{
    public function string(): StringSchema
    {
        return new StringSchema();
    }

    public function number(): NumberSchema
    {
        return new NumberSchema();
    }

    public function array(): ArraySchema
    {
        return new ArraySchema();
    }
}
