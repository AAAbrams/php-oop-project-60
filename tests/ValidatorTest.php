<?php

declare(strict_types=1);

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Schemas\ArraySchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;
use Hexlet\Validator\Validator;
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

        $this->assertFalse($schema->isValid(0));

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
        $this->assertTrue($schema->isValid(['validator']));
        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['validator']));
        $this->assertTrue($schema->isValid(['validator', 'codding']));
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

    public function testMacroFeature(): void
    {
        $v = new Validator();

        $v->addValidator('string', 'startWith', fn($value, $start) => str_starts_with($value, $start));

        $schema = $v->string()->test('startWith', 'H');

        $this->assertTrue($schema->isValid('Hexlet'));
        $this->assertFalse($schema->isValid('exlet'));

        $v->addValidator('number', 'min', fn($value, $min) => $value >= $min);

        $schema = $v->number()->test('min', 5);

        $this->assertTrue($schema->isValid(6));
        $this->assertFalse($schema->isValid(2));
    }
}
