<?php declare(strict_types=1);

use Monopage\Properties\LocaleProperty;
use Monopage\Properties\Exceptions\PropertyValidationException;
use PHPUnit\Framework\TestCase;

class LocalePropertyTest extends TestCase
{
    public function testEmpty(): void
    {
        $this->expectException(PropertyValidationException::class);
        LocaleProperty::create('');
    }

    public function testToLongLanguage(): void
    {
        $this->expectException(PropertyValidationException::class);
        LocaleProperty::create('abc');
    }

    public function testToLongTerritory(): void
    {
        $this->expectException(PropertyValidationException::class);
        LocaleProperty::create('ab', 'ABC');
    }

    public function testInvalidChars(): void
    {
        $this->expectException(PropertyValidationException::class);
        LocaleProperty::create('ой');
    }

    public function testString(): void
    {
        $this->assertEquals('ru-RU', (string)LocaleProperty::create('ru', 'RU'));
    }

    public function testLanguage(): void
    {
        $this->assertEquals('ru', LocaleProperty::create('ru', 'RU')->getLanguageSegment());
    }

    public function testTerritory(): void
    {
        $this->assertEquals('RU', LocaleProperty::create('ru', 'RU')->getTerritorySegment());
    }
}
