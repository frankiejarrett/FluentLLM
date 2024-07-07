<?php

namespace FluentLLM\Traits;

trait HasFallback
{
    protected array $fallbackDrivers = [];

    public function fallback(string ...$drivers): self
    {
        $this->fallbackDrivers = $drivers;

        return $this;
    }

    protected function shouldFallback(): bool
    {
        return $this->getConfig('fallback.enabled', false) && ! empty($this->fallbackDrivers);
    }

    protected function executeFallback(): mixed
    {
        foreach ($this->fallbackDrivers as $driver) {
            try {
                $this->driver($driver);

                return $this->sendRequest();
            } catch (\Exception $e) {
                continue;
            }
        }

        throw new \Exception('All fallback drivers failed');
    }
}
