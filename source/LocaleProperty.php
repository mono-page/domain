<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;
use Monopage\Properties\Validation\Result;

class LocaleProperty implements ValueObjectInterface, StringableInterface
{
    protected string $languageSegment;
    protected string $territorySegment;

    protected function __construct(string $language, string $territory)
    {
        $this->languageSegment = $language;
        $this->territorySegment = $territory;
    }

    public function getLocaleString(): string
    {
        return sprintf(
            '%s%s',
            $this->languageSegment,
            ('' !== $this->territorySegment) ? "-{$this->territorySegment}" : ''
        );
    }

    public function getLanguageSegment(): string
    {
        return $this->languageSegment;
    }

    public function getTerritorySegment(): string
    {
        return $this->territorySegment;
    }

    public function __toString(): string
    {
        return $this->getLocaleString();
    }

    /**
     * @param string $language
     * @param string $territory
     *
     * @return static
     *
     * @throws PropertyValidationException
     */
    public static function create(string $language, string $territory = ''): self
    {
        $validation = self::validateLanguageSegment($language);
        if (!$validation->isSuccess()) {
            throw new PropertyValidationException($validation->getMessage());
        }

        $validation = self::validateTerritorySegment($territory);
        if (!$validation->isSuccess()) {
            throw new PropertyValidationException($validation->getMessage());
        }

        return new self($language, $territory);
    }

    public static function validateLanguageSegment(string $value): Result
    {
        if (!preg_match('/^[a-z]{2}$/', $value)) {
            return Result::failure(sprintf(
                'Segment "%s" in "%s" property can only consist of two lowercase Latin letters',
                'language',
                self::class
            ));
        }

        return Result::success();
    }

    public static function validateTerritorySegment(string $value): Result
    {
        if (!('' === $value || preg_match('/^[A-Z]{2}$/', $value))) {
            return Result::failure(sprintf(
                'Segment "%s" in "%s" property can be empty or consist of two capital Latin letters',
                'territory',
                self::class
            ));
        }

        return Result::success();
    }
}
