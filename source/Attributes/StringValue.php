<?php declare(strict_types=1);

namespace Monopage\Domain\Attributes;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;

class StringValue implements ValueObjectInterface, StringableInterface
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
        if (($length = strlen($value)) > 65_535) {
            throw new InvalidAttributeValueException(sprintf(
                'Attribute "%s" can contain a value between 0 and 65535 characters. Now length: %d',
                self::class,
                $length
            ));
        }

        $this->value = $value;

        return $this;
    }

    public function getLength(): int
    {
        return strlen($this->value);
    }

    public function isEmpty(): bool
    {
        return '' === $this->value;
    }
}
