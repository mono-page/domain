<?php declare(strict_types=1);

use Monopage\Properties\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->assertTrue(Validation::success()->isSuccess());
    }

    public function testFailure(): void
    {
        $this->assertFalse(Validation::failure('')->isSuccess());
    }

    public function testMessage(): void
    {
        $this->assertEquals('message', Validation::failure('message')->getMessage());
    }
}
