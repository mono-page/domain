<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\Validation\Result;

class AliasProperty implements ValueObjectInterface, StringableInterface
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
        if (($length = strlen($value)) === 0 || $length > 100) {
            return Result::failure(sprintf(
                'Property "%s" can contain a value between 1 and 100 characters. Now length: %d',
                self::class,
                $length
            ));
        }

        if (preg_match('/[^a-z0-9_]+/', $value) > 0) {
            return Result::failure(sprintf(
                'Property "%s" can only consist of valid characters: a-z, A-Z, 0-9, _',
                self::class
            ));
        }

        return Result::success();
    }
}
