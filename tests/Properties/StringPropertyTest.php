<?php declare(strict_types=1);

use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\StringProperty;
use PHPUnit\Framework\TestCase;

class StringPropertyTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->assertTrue(StringProperty::create('')->isEmpty());
    }

    public function testToLong(): void
    {
        $this->expectException(PropertyValidationException::class);
        StringProperty::create(str_repeat('x', 65_536));
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)StringProperty::create('example'));
    }
}
