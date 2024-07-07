<?php

namespace FluentLLM\Traits;

use FluentLLM\Jobs\ProcessRequest;
use Illuminate\Support\Facades\Queue;

trait HasAsyncRequests
{
    public function dispatch(): mixed
    {
        return Queue::push(new ProcessRequest($this->requestBuilder->build()));
    }

    public function dispatchIf(bool $condition): mixed
    {
        return $condition ? $this->dispatch() : $this->run();
    }

    public function dispatchUnless(bool $condition): mixed
    {
        return $this->dispatchIf(! $condition);
    }

    public function onQueue(string $queue): mixed
    {
        return Queue::pushOn($queue, new ProcessRequest($this->requestBuilder->build()));
    }

    public function delay(int $delay): mixed
    {
        return Queue::later($delay, new ProcessRequest($this->requestBuilder->build()));
    }
}
