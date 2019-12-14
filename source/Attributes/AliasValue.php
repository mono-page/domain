<?php declare(strict_types=1);

namespace Monopage\Domain\Attributes;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;

class AliasValue implements ValueObjectInterface, StringableInterface
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        if (($length = strlen($value)) === 0 || $length > 100) {
            throw new InvalidAttributeValueException(sprintf(
                'Attribute "%s" can contain a value between 1 and 100 characters. Now length: %d',
                self::class,
                $length
            ));
        }
        if (preg_match('/[^\W]/', $value) > 0) {
            throw new InvalidAttributeValueException(sprintf(
                'Attribute "%s" can only consist of valid characters: a-z, A-Z, 0-9, _',
                self::class
            ));
        }
        $this->value = $value;

        return $this;
    }

    public function getLength(): int
    {
        return strlen($this->value);
    }
}
