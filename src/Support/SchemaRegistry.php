<?php

declare(strict_types=1);

namespace Alligator\Support;

use Alligator\Schemas\ArraySchema;
use Alligator\Schemas\NumberSchema;
use Alligator\Schemas\StringSchema;

enum SchemaRegistry: string
{
    case string = 'string';
    case number = 'number';

    case array = 'array';

    public function getClassName(): ?string
    {
        return match ($this) {
            self::string => StringSchema::class,
            self::number => NumberSchema::class,
            self::array => ArraySchema::class,
        };
    }
}
