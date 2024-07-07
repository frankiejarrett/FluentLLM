<?php

namespace FluentLLM\Events;

class RequestRetrying
{
    public function __construct(public int $attempt, public int $maxAttempts)
    {
    }
}
