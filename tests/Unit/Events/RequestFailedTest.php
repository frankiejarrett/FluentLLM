<?php

namespace FluentLLM\Tests\Unit\Events;

use FluentLLM\Events\RequestFailed;
use FluentLLM\Tests\TestCase;

class RequestFailedTest extends TestCase
{
    public function test_request_failed_event()
    {
        $exception = new \Exception('Test exception');
        $event = new RequestFailed($exception);
        $this->assertSame($exception, $event->exception);
    }
}
