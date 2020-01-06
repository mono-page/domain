<?php declare(strict_types=1);

use Monopage\Properties\DateTimeProperty;
use Monopage\Properties\Exceptions\PropertyValidationException;
use PHPUnit\Framework\TestCase;

class DateTimePropertyTest extends TestCase
{
    public function testWrong(): void
    {
        $this->expectException(PropertyValidationException::class);
        DateTimeProperty::create('-');
    }

    public function testString(): void
    {
        $value = date('c');
        $this->assertEquals($value, (string)DateTimeProperty::create($value));
    }
}
