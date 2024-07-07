<?php

namespace FluentLLM\Tests;

use FluentLLM\FluentLLM;
use FluentLLM\Support\RequestBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

class FakeFluentLLM extends FluentLLM
{
    protected Collection $expectedResponses;

    protected Collection $recordedRequests;

    public function __construct(Application $app = null)
    {
        if ($app) {
            parent::__construct($app);
        } else {
            $this->requestBuilder = new RequestBuilder();
        }

        $this->expectedResponses = collect();
        $this->recordedRequests = collect();
    }

    public function expectResponse(mixed $response): self
    {
        $this->expectedResponses->push($response);

        return $this;
    }

    protected function sendRequest(): mixed
    {
        $this->recordedRequests->push([
            'messages' => $this->requestBuilder->getMessages(),
            'options' => $this->requestBuilder->getOptions(),
        ]);

        return $this->expectedResponses->shift() ?? 'Fake response';
    }

    public function getRecordedRequests(): Collection
    {
        return $this->recordedRequests;
    }
}
