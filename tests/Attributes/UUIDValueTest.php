<?php declare(strict_types=1);

use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;
use Monopage\Domain\Attributes\UUIDValue;
use PHPUnit\Framework\TestCase;

class UUIDValueTest extends TestCase
{
    public function testInvalid(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        UUIDValue::create('x');
    }

    public function testString(): void
    {
        $this->assertEquals('00112233-4455-6677-8899-AABBCCDDEEFF', (string)UUIDValue::create('00112233-4455-6677-8899-AABBCCDDEEFF'));
    }
}
