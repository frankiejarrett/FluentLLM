<?php

namespace FluentLLM\Tests\Unit\Exceptions;

use FluentLLM\Exceptions\DriverNotFoundException;
use FluentLLM\Tests\TestCase;

class DriverNotFoundExceptionTest extends TestCase
{
    public function test_driver_not_found_exception()
    {
        $exception = new DriverNotFoundException('test-driver');
        $this->assertEquals('Driver [test-driver] not found.', $exception->getMessage());
    }
}
