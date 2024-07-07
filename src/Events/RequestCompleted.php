<?php

namespace FluentLLM\Events;

class RequestCompleted
{
    public function __construct(public mixed $response)
    {
    }
}
