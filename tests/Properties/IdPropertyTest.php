<?php declare(strict_types=1);

use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\IdProperty;
use PHPUnit\Framework\TestCase;

class IdPropertyTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(PropertyValidationException::class);
        IdProperty::create('');
    }

    public function testToLong(): void
    {
        $this->expectException(PropertyValidationException::class);
        IdProperty::create(str_repeat('x', 101));
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)IdProperty::create('example'));
    }
}
