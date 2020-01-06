<?php declare(strict_types=1);

use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\UuidProperty;
use PHPUnit\Framework\TestCase;

class UuidPropertyTest extends TestCase
{
    public function testInvalid(): void
    {
        $this->expectException(PropertyValidationException::class);
        UuidProperty::create('x');
    }

    public function testString(): void
    {
        $this->assertEquals('00112233-4455-6677-8899-AABBCCDDEEFF', (string)UuidProperty::create('00112233-4455-6677-8899-AABBCCDDEEFF'));
    }
}
