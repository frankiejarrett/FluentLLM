<?php

namespace FluentLLM\Contracts;

use Illuminate\Support\Collection;

interface Driver
{
    public function sendRequest(Collection $messages, Collection $options = new Collection()): mixed;

    public function streamRequest(Collection $messages, Collection $options = new Collection()): \Generator;
}
