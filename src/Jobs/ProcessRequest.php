<?php

namespace FluentLLM\Jobs;

use FluentLLM\FluentLLM;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ProcessRequest implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    protected Collection $messages;

    protected Collection $options;

    public function __construct(Collection $messages, Collection $options)
    {
        $this->messages = $messages;
        $this->options = $options;
    }

    public function handle(FluentLLM $llm)
    {
        return $llm->driver()->sendRequest($this->messages, $this->options);
    }
}
