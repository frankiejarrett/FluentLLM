<?php

namespace FluentLLM\Drivers;

use FluentLLM\Contracts\Driver;
use Illuminate\Support\Collection;

class Anthropic implements Driver
{
    public function sendRequest(Collection $messages, Collection $options = new Collection()): mixed
    {
        return 'Example response';
    }

    public function streamRequest(Collection $messages, Collection $options = new Collection()): \Generator
    {
        yield 'Example stream';
    }
}
