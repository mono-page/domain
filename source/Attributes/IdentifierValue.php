<?php declare(strict_types=1);

namespace Monopage\Domain\Attributes;

use Monopage\Contracts\IdentifierInterface;
use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;

class IdentifierValue implements ValueObjectInterface, IdentifierInterface, StringableInterface
{
    protected string $value;

    public function __construct(string $value)
    {
        if (($length = strlen($value)) === 0 || $length > 100) {
            throw new InvalidAttributeValueException(sprintf(
                'Attribute "%s" can contain a value between 1 and 100 characters. Now length %d',
                self::class,
                $length
            ));
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
