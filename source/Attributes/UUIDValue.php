<?php declare(strict_types=1);

namespace Monopage\Domain\Attributes;

use Monopage\Contracts\IdentifierInterface;
use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Domain\Attributes\Exceptions\InvalidAttributeValueException;

class UUIDValue implements ValueObjectInterface, StringableInterface, IdentifierInterface
{
    protected string $value;

    protected function __construct(string $value)
    {
        if (!preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/', $value)) {
            throw new InvalidAttributeValueException(sprintf(
                'Attribute "%s" can only consist of valid uppercase UUID characters',
                self::class
            ));
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @return static
     *
     * @throws InvalidAttributeValueException
     */
    public static function create(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
