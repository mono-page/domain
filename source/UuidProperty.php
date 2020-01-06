<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\IdentifierInterface;
use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\Validation\Result;

class UuidProperty implements ValueObjectInterface, StringableInterface, IdentifierInterface
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
        if (!preg_match('/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i', $value)) {
            return Result::failure(sprintf(
                'Property "%s" can only consist of valid UUID characters',
                self::class
            ));
        }

        return Result::success();
    }
}
