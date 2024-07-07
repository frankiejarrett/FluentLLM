<?php

namespace FluentLLM\Tests\Unit\Events;

use FluentLLM\Events\RequestStarting;
use FluentLLM\Tests\TestCase;
use Illuminate\Support\Collection;

class RequestStartingTest extends TestCase
{
    public function test_request_starting_event()
    {
        $messages = new Collection([['role' => 'user', 'content' => 'Test message']]);
        $options = new Collection(['model' => 'gpt-3.5-turbo']);
        $event = new RequestStarting($messages, $options);
        $this->assertEquals($messages, $event->messages);
        $this->assertEquals($options, $event->options);
    }
}