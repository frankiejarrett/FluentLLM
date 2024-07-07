<?php

namespace FluentLLM\Tests;

use FluentLLM\FluentLLM;
use FluentLLM\FluentLLMServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            FluentLLMServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->singleton('fluentllm', function ($app) {
            return new FluentLLM($app);
        });
    }
}
