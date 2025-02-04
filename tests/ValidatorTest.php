<?php

declare(strict_types=1);

use Alligator\Schemas\SchemaInterface;
use Alligator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testString()
    {
        
        $schema = $this->validator->string();
        $schema2 = $this->validator->string();

        $this->assertInstanceOf(SchemaInterface::class, $schema);
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
}
