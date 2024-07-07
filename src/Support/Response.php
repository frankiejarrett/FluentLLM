<?php

namespace FluentLLM\Support;

use FluentLLM\Contracts\Response as ResponseContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Response implements ResponseContract, Arrayable, Jsonable
{
    protected string $content;

    protected int $tokenCount;

    protected array $raw;

    public function __construct(string $content, int $tokenCount = 0, array $raw = [])
    {
        $this->content = $content;
        $this->tokenCount = $tokenCount;
        $this->raw = $raw;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function tokenCount(): int
    {
        return $this->tokenCount;
    }

    public function raw(): array
    {
        return $this->raw;
    }

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'token_count' => $this->tokenCount,
            'raw' => $this->raw,
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString(): string
    {
        return $this->content;
    }
}
