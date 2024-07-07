<?php

namespace FluentLLM\Events;

use Illuminate\Support\Collection;

class RequestStarting
{
    public function __construct(public Collection $messages, public Collection $options)
    {
    }
}
