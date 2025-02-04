<?php

declare(strict_types=1);

namespace Alligator\Tests;

use Alligator\Schemas\ArraySchema;
use Alligator\Schemas\NumberSchema;
use Alligator\Schemas\StringSchema;
use Alligator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testString(): void
    {

        $schema = $this->validator->string();
        $schema2 = $this->validator->string();

        $this->assertInstanceOf(StringSchema::class, $schema);
        $this->assertTrue($schema->isValid());
        $schema->required();
        $this->assertFalse($schema->isValid());
        $this->assertTrue($schema2->isValid(''));
        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertTrue(
            $schema->contains('what')
            ->isValid('what does the fox say')
        );
        $this->assertFalse(
            $schema->contains('whatthe')
                ->isValid('what does the fox say')
        );

        $this->assertTrue(
            $this->validator->string()
                ->minLength(10)
                ->minLength(5)
                ->isValid('Hexlet')
        );
    }

    public function testNumber(): void
    {
        $schema = $this->validator->number();

        $this->assertInstanceOf(NumberSchema::class, $schema);

        $this->assertTrue($schema->isValid());
        $schema->required();
        $this->assertFalse($schema->isValid());
        $this->assertTrue($schema->isValid(7));

        $this->assertTrue(
            $schema->positive()->isValid(10)
        );

        $schema->range(-5, 5);

        $this->assertFalse(
            $schema->isValid(-3)
        );

        $this->assertTrue(
            $schema->isValid(5)
        );

        $schema2 = $this->validator
            ->number()
            ->range(-4, 4);

        $this->assertTrue($schema2->isValid(0));
        $this->assertTrue($schema2->isValid(3));
        $this->assertTrue($schema2->isValid(-4));
        $this->assertFalse($schema2->isValid(-5));
        $this->assertFalse($schema2->isValid(10));
    }

    public function testArray(): void
    {
        $schema = $this->validator->array();

        $this->assertInstanceOf(ArraySchema::class, $schema);

        $this->assertTrue($schema->isValid());
        $schema->required();
        $this->assertFalse($schema->isValid());
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['alligator']));
        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['alligator']));
        $this->assertTrue($schema->isValid(['alligator', 'codding']));
    }

    public function testArrayShapeExtension(): void
    {
        $schema = $this->validator->array();
        $schema->shape([
            'name' => $this->validator->string()->required(),
            'age' => $this->validator->number()->positive(),
        ]);

        $this->assertTrue(
            $schema->isValid(['name' => 'kolya', 'age' => 100])
        );
        $this->assertTrue(
            $schema->isValid(['name' => 'maya', 'age' => null])
        );
        $this->assertFalse(
            $schema->isValid(['name' => '', 'age' => null])
        );
        $this->assertFalse(
            $schema->isValid(['name' => 'ada', 'age' => -5])
        );
    }
}
