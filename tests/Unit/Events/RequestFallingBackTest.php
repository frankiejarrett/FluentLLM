<?php

namespace FluentLLM\Tests\Unit\Events;

use FluentLLM\Events\RequestFallingBack;
use FluentLLM\Tests\TestCase;

class RequestFallingBackTest extends TestCase
{
    public function test_request_falling_back_event()
    {
        $event = new RequestFallingBack('openai', 'anthropic');
        $this->assertEquals('openai', $event->fromDriver);
        $this->assertEquals('anthropic', $event->toDriver);
    }
}
