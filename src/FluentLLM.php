<?php

namespace FluentLLM;

use FluentLLM\Contracts\Driver;
use FluentLLM\Support\RequestBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Manager;

class FluentLLM extends Manager
{
    use Traits\HasAsyncRequests,
        Traits\HasConfig,
        Traits\HasEvents,
        Traits\HasFallback,
        Traits\HasMessages,
        Traits\HasRetries;

    protected RequestBuilder $requestBuilder;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->requestBuilder = new RequestBuilder();
    }

    public function getDefaultDriver(): string
    {
        return $this->config->get('llm.default');
    }

    protected function createDriver($driver): Driver
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $method = 'create'.ucfirst($driver).'Driver';

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new \InvalidArgumentException("Driver [$driver] not supported.");
    }

    protected function createAnthropicDriver(): Driver
    {
        return new Drivers\Anthropic($this->config->get('llm.drivers.anthropic', []));
    }

    protected function createGoogleDriver(): Driver
    {
        return new Drivers\Google($this->config->get('llm.drivers.google', []));
    }

    protected function createGroqDriver(): Driver
    {
        return new Drivers\Groq($this->config->get('llm.drivers.groq', []));
    }

    protected function createOpenAiDriver(): Driver
    {
        return new Drivers\OpenAI($this->config->get('llm.drivers.openai', []));
    }

    public function model(string $model): self
    {
        $this->requestBuilder->setOption('model', $model);

        return $this;
    }

    public function run(): mixed
    {
        $this->fireEvent('RequestStarting', $this->requestBuilder->getMessages(), $this->requestBuilder->getOptions());

        try {
            $response = $this->sendRequest();
            $this->fireEvent('RequestCompleted', $response);

            return $response;
        } catch (\Exception $e) {
            $this->fireEvent('RequestFailed', $e);

            if ($this->shouldRetry($e)) {
                return $this->retry();
            }

            if ($this->shouldFallback()) {
                return $this->executeFallback();
            }

            throw $e;
        }
    }

    protected function sendRequest(): mixed
    {
        return $this->driver()->sendRequest(
            $this->requestBuilder->getMessages(),
            $this->requestBuilder->getOptions()
        );
    }

    public function stream(): \Generator
    {
        $this->fireEvent('RequestStarting', $this->requestBuilder->getMessages(), $this->requestBuilder->getOptions());

        try {
            $generator = $this->driver()->streamRequest(
                $this->requestBuilder->getMessages(),
                $this->requestBuilder->getOptions()
            );

            foreach ($generator as $chunk) {
                $this->fireEvent('ResponseChunkReceived', $chunk);
                yield $chunk;
            }

            $this->fireEvent('RequestCompleted');
        } catch (\Exception $e) {
            $this->fireEvent('RequestFailed', $e);
            throw $e;
        }
    }

    public function extend($driver, \Closure $callback): self
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }
}
