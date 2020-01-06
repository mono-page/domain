<?php declare(strict_types=1);

use Monopage\Properties\AliasProperty;
use Monopage\Properties\Exceptions\PropertyValidationException;
use PHPUnit\Framework\TestCase;

class AliasPropertyTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(PropertyValidationException::class);
        AliasProperty::create('');
    }

    public function testToLong(): void
    {
        $this->expectException(PropertyValidationException::class);
        AliasProperty::create(str_repeat('x', 101));
    }

    public function testInvalidChars(): void
    {
        $this->expectException(PropertyValidationException::class);
        AliasProperty::create('ой');
    }

    public function testString(): void
    {
        $this->assertEquals('example', (string)AliasProperty::create('example'));
    }
}
