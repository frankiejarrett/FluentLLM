<?php

namespace FluentLLM\Tests\Unit\Events;

use FluentLLM\Events\RequestCompleted;
use FluentLLM\Tests\TestCase;

class RequestCompletedTest extends TestCase
{
    public function test_request_completed_event()
    {
        $event = new RequestCompleted('Test response');
        $this->assertEquals('Test response', $event->response);
    }
}
