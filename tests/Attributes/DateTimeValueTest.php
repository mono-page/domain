<?php declare(strict_types=1);

use Monopage\Domain\Attributes\DateTimeValue;
use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;
use PHPUnit\Framework\TestCase;

class DateTimeValueTest extends TestCase
{
    public function testWrong(): void
    {
        $this->expectException(InvalidAttributeValueException::class);
        DateTimeValue::create('-');
    }

    public function testString(): void
    {
        $value = date('c');
        $this->assertEquals($value, (string)DateTimeValue::create($value));
    }
}
