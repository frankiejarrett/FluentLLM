<?php

namespace FluentLLM\Contracts;

interface Response
{
    public function content(): string;

    public function tokenCount(): int;

    public function raw(): array;
}
