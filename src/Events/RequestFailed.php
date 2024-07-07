<?php

namespace FluentLLM\Events;

class RequestFailed
{
    public function __construct(public \Exception $exception)
    {
    }
}
