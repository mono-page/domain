<?php declare(strict_types=1);

namespace Monopage\Properties;

class Validation
{
    protected bool $success;
    protected string $message;

    public static function success(): self
    {
        return new self(true);
    }

    public static function failure(string $message): self
    {
        return new self(false, $message);
    }

    protected function __construct(bool $success, string $message = '')
    {
        $this->success = $success;
        $this->message = $message;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
