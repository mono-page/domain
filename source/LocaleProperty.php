<?php declare(strict_types=1);

namespace Monopage\Properties;

use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;
use Monopage\Properties\Exceptions\PropertyValidationException;

class LocaleProperty implements ValueObjectInterface, StringableInterface
{
    protected string $languageSegment;
    protected string $territorySegment;

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
        return new self($language, $territory);
    }

    protected function __construct(string $language, string $territory)
    {
        if (!preg_match('/^[a-z]{2}$/', $language)) {
            throw new PropertyValidationException(sprintf(
                'Segment "%s" in "%s" property can only consist of two lowercase Latin letters',
                'language',
                self::class
            ));
        }

        if (!('' === $territory || preg_match('/^[A-Z]{2}$/', $territory))) {
            throw new PropertyValidationException(sprintf(
                'Segment "%s" in "%s" property can be empty or consist of two capital Latin letters',
                'territory',
                self::class
            ));
        }

        $this->languageSegment = $language;
        $this->territorySegment = $territory;
    }

    public function getLocaleString(): string
    {
        return sprintf(
            '%s%s',
            $this->languageSegment,
            $this->territorySegment ? "-{$this->territorySegment}" : ''
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
}
