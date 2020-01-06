<?php declare(strict_types=1);

namespace Monopage\Properties\Exceptions;

use LogicException;
use Monopage\Contracts\ExceptionInterface;

class PropertyException extends LogicException implements ExceptionInterface
{
}
