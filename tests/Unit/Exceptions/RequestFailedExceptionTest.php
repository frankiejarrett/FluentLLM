<?php

namespace FluentLLM\Tests\Unit\Exceptions;

use FluentLLM\Exceptions\RequestFailedException;
use FluentLLM\Tests\TestCase;

class RequestFailedExceptionTest extends TestCase
{
    public function test_request_failed_exception()
    {
        $exception = new RequestFailedException('API error');
        $this->assertEquals('Request failed: API error', $exception->getMessage());
    }
}
