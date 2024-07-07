<?php

namespace FluentLLM\Support;

use Illuminate\Support\Collection;

class RequestBuilder
{
    protected Collection $messages;

    protected Collection $options;

    public function __construct()
    {
        $this->messages = new Collection();
        $this->options = new Collection();
    }

    public function addMessage(string $role, string $content): self
    {
        if (! in_array($role, ['system', 'user', 'assistant'], true)) {
            throw new \InvalidArgumentException("Invalid message role '{$role}'.");
        }

        if ($role === 'system') {
            $messageKey = $this->messages->filter(function ($message) {
                return $message['role'] === 'system';
            });

            if ($messageKey) {
                $this->messages->put($messageKey, [
                    'role' => 'system',
                    'content' => "{$this->messages[$messageKey]['content']}\n\n{$content}",
                ]);
            } else {
                $this->messages->prepend([
                    'role' => 'system',
                    'content' => $content,
                ]);
            }
        } else {
            $this->messages->push([
                'role' => $role,
                'content' => $content,
            ]);
        }

        return $this;
    }

    public function setOption(string $key, mixed $value): self
    {
        $this->options->put($key, $value);

        return $this;
    }

    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function build(): array
    {
        return [
            'messages' => $this->messages->toArray(),
            'options' => $this->options->toArray(),
        ];
    }
}
