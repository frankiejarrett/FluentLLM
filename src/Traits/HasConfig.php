<?php

namespace FluentLLM\Traits;

use Illuminate\Support\Collection;

trait HasConfig
{
    protected Collection $runtimeConfig;

    protected function initializeConfig(): void
    {
        $this->runtimeConfig = new Collection();
    }

    public function getConfig(string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->runtimeConfig->merge($this->config);
        }

        return $this->runtimeConfig->get($key) ?? data_get($this->config, $key, $default);
    }

    public function setConfig(string|array $key, mixed $value = null): self
    {
        if (is_array($key)) {
            $this->runtimeConfig = $this->runtimeConfig->merge($key);
        } else {
            $this->runtimeConfig->put($key, $value);
        }

        return $this;
    }
}
