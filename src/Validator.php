<?php

declare(strict_types=1);

namespace Alligator;

use Alligator\Schemas\SchemaInterface;
use Alligator\Schemas\StringSchema;

class Validator
{
    public function string(array $options = []): SchemaInterface
    {
        return new StringSchema($options);
    }
}
