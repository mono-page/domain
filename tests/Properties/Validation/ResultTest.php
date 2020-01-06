<?php declare(strict_types=1);

use Monopage\Properties\Validation\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->assertTrue(Result::success()->isSuccess());
    }

    public function testFailure(): void
    {
        $this->assertFalse(Result::failure('')->isSuccess());
    }

    public function testMessage(): void
    {
        $this->assertEquals('message', Result::failure('message')->getMessage());
    }
}
