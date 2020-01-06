<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;

class StringProperty implements ValueObjectInterface, StringableInterface
{
    protected string $value;

    protected function __construct(string $value)
    {
        if (($length = strlen($value)) > 65_535) {
            throw new PropertyValidationException(sprintf(
                'Property "%s" can contain a value between 0 and 65535 characters. Now length: %d',
                self::class,
                $length
            ));
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @return static
     *
     * @throws PropertyValidationException
     */
    public static function create(string $value): self
    {
        return new self($value);
    }

    public function isEmpty(): bool
    {
        return $this->getValue() === '';
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
