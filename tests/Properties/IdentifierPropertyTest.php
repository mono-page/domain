<?php declare(strict_types=1);

use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\IdentifierProperty;
use PHPUnit\Framework\TestCase;

class IdentifierPropertyTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(PropertyValidationException::class);
        IdentifierProperty::create('');
    }

    public function testToLong(): void
    {
        $this->expectException(PropertyValidationException::class);
        IdentifierProperty::create(str_repeat('x', 101));
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)IdentifierProperty::create('example'));
    }
}
