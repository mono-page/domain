<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;

class AliasProperty implements ValueObjectInterface, StringableInterface
{
    protected string $value;

    protected function __construct(string $value)
    {
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
        if (($length = strlen($value)) === 0 || $length > 100) {
            throw new PropertyValidationException(sprintf(
                'Property "%s" can contain a value between 1 and 100 characters. Now length: %d',
                self::class,
                $length
            ));
        }

        if (preg_match('/[^a-z0-9_]+/', $value) > 0) {
            throw new PropertyValidationException(sprintf(
                'Property "%s" can only consist of valid characters: a-z, A-Z, 0-9, _',
                self::class
            ));
        }

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
