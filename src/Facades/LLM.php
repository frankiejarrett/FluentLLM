<?php

namespace FluentLLM\Facades;

use FluentLLM\Tests\FakeFluentLLM;
use Illuminate\Support\Facades\Facade;

class LLM extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fluentllm';
    }

    public static function fake($fake = null): void
    {
        static::swap($fake ?: new FakeFluentLLM);
    }
}
