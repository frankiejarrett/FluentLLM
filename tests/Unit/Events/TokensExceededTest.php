<?php

namespace FluentLLM\Tests\Unit\Events;

use FluentLLM\Events\TokensExceeded;
use FluentLLM\Tests\TestCase;

class TokensExceededTest extends TestCase
{
    public function test_tokens_exceeded_event()
    {
        $event = new TokensExceeded(4096, 4000);
        $this->assertEquals(4096, $event->tokenCount);
        $this->assertEquals(4000, $event->maxTokens);
    }
}
