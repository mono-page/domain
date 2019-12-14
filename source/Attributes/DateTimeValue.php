<?php declare(strict_types=1);

namespace Monopage\Domain\Attributes;

use DateTimeImmutable;
use Monopage\Contracts\StringableInterface;
use Monopage\Contracts\ValueObjectInterface;

class DateTimeValue extends DateTimeImmutable implements ValueObjectInterface, StringableInterface
{
    public function __toString(): string
    {
        return $this->format('c'); # ISO8601 'Y-m-d\TH:i:sO'
    }
}
