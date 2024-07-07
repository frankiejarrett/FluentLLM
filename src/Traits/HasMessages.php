<?php

namespace FluentLLM\Traits;

use Illuminate\Support\Collection;

/**
 * @property \FluentLLM\Support\RequestBuilder $requestBuilder
 */
trait HasMessages
{
    public function message(string $role, string $content): self
    {
        $this->requestBuilder->addMessage($role, $content);

        return $this;
    }

    public function system(string $content): self
    {
        return $this->message('system', $content);
    }

    public function user(string $content): self
    {
        return $this->message('user', $content);
    }

    public function assistant(string $content): self
    {
        return $this->message('assistant', $content);
    }

    public function getMessages(): Collection
    {
        return $this->requestBuilder->getMessages();
    }
}
