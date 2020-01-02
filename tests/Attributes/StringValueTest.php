<?php declare(strict_types=1);

use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;
use Monopage\Domain\Attributes\StringValue;
use PHPUnit\Framework\TestCase;

class StringValueTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->assertTrue(StringValue::create('')->isEmpty());
    }

    public function testToLong(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        StringValue::create(str_repeat('x', 65_536));
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)StringValue::create('example'));
    }
}
