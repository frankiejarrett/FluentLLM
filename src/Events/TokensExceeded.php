<?php

namespace FluentLLM\Events;

class TokensExceeded
{
    public function __construct(public int $tokenCount, public int $maxTokens)
    {
    }
}
