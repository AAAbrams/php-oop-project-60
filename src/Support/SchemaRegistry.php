<?php

declare(strict_types=1);

namespace Hexlet\Validator\Support;

use Hexlet\Validator\Schemas\ArraySchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;

enum SchemaRegistry: string
{
    case string = 'string';
    case number = 'number';

    case array = 'array';

    public function getClassName(): string
    {
        return match ($this) {
            self::string => StringSchema::class,
            self::number => NumberSchema::class,
            self::array => ArraySchema::class,
        };
    }
}
