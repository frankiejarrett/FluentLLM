<?php

namespace FluentLLM\Tests\Unit\Events;

use FluentLLM\Events\RequestRetrying;
use FluentLLM\Tests\TestCase;

class RequestRetryingTest extends TestCase
{
    public function test_request_retrying_event()
    {
        $event = new RequestRetrying(2, 3);
        $this->assertEquals(2, $event->attempt);
        $this->assertEquals(3, $event->maxAttempts);
    }
}
