<?php declare(strict_types=1);

use Monopage\Domain\Attributes\AliasValue;
use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;
use PHPUnit\Framework\TestCase;

class AliasValueTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        AliasValue::create('');
    }

    public function testToLong(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        AliasValue::create(str_repeat('x', 101));
    }

    public function testInvalidChars(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        AliasValue::create('ой');
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)AliasValue::create('example'));
    }
}
