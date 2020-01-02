<?php declare(strict_types=1);

use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;
use Monopage\Domain\Attributes\IdentifierValue;
use PHPUnit\Framework\TestCase;

class IdentifierValueTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        IdentifierValue::create('');
    }

    public function testToLong(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        IdentifierValue::create(str_repeat('x', 101));
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)IdentifierValue::create('example'));
    }
}
