<?php

namespace FluentLLM\Traits;

use FluentLLM\Jobs\ProcessRequest;
use Illuminate\Support\Facades\Queue;

/**
 * @property \FluentLLM\Support\RequestBuilder $requestBuilder
 */
trait HasAsyncRequests
{
    public function dispatch(): mixed
    {
        return Queue::push(new ProcessRequest(...$this->requestBuilder->build()));
    }

    public function dispatchIf($boolean): mixed
    {
        return value($boolean) ? $this->dispatch() : null;
    }

    public function dispatchUnless($boolean): mixed
    {
        return ! value($boolean) ? $this->dispatch() : null;
    }

    public function onQueue(string $queue): mixed
    {
        return Queue::pushOn($queue, new ProcessRequest(...$this->requestBuilder->build()));
    }

    public function delay(int $delay): mixed
    {
        return Queue::later($delay, new ProcessRequest(...$this->requestBuilder->build()));
    }
}
