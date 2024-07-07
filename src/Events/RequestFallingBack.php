<?php

namespace FluentLLM\Events;

class RequestFallingBack
{
    public function __construct(public string $fromDriver, public string $toDriver)
    {
    }
}
