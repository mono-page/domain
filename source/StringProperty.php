<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\Validation\Result;

class StringProperty implements ValueObjectInterface, StringableInterface
{
    protected string $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEmpty(): bool
    {
        return $this->getValue() === '';
    }

    public function __toString(): string
    {
        return $this->getValue();
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
        $validation = self::validate($value);
        if (!$validation->isSuccess()) {
            throw new PropertyValidationException($validation->getMessage());
        }

        return new self($value);
    }

    public static function validate(string $value): Result
    {
        if (($length = strlen($value)) > 65_535) {
            return Result::failure(sprintf(
                'Property "%s" can contain a value between 0 and 65535 characters. Now length: %d',
                self::class,
                $length
            ));
        }

        return Result::success();
    }
}
