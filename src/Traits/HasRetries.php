<?php

namespace FluentLLM\Traits;

use Illuminate\Support\Facades\RateLimiter;

/**
 * @property \FluentLLM\Support\RequestBuilder $requestBuilder
 */
trait HasRetries
{
    protected int $maxAttempts;

    protected int $attemptCount = 0;

    public function setMaxAttempts(int $attempts): self
    {
        $this->maxAttempts = $attempts;

        return $this;
    }

    protected function shouldRetry(\Exception $e): bool
    {
        return $this->attemptCount < $this->getConfig('retry.max_attempts', 3) &&
               $this->isRetryableException($e);
    }

    protected function isRetryableException(\Exception $e): bool
    {
        // Implement logic to determine if the exception is retryable
        // For example, retry on network errors or rate limit errors
        return true;
    }

    protected function retry(): mixed
    {
        $this->attemptCount++;

        $delay = $this->getRetryDelay();

        RateLimiter::hit($this->getRetryKey(), $delay);

        return $this->sendRequest();
    }

    protected function getRetryDelay(): int
    {
        $initialInterval = $this->getConfig('retry.initial_interval', 1000);
        $multiplier = $this->getConfig('retry.interval_multiplier', 2);
        $maxInterval = $this->getConfig('retry.max_interval', 10000);

        $delay = $initialInterval * pow($multiplier, $this->attemptCount - 1);

        return min($delay, $maxInterval);
    }

    protected function getRetryKey(): string
    {
        return 'llm_retry:'.md5(serialize($this->requestBuilder->build()));
    }
}
