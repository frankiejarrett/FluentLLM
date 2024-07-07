<?php

namespace FluentLLM\Tests;

use FluentLLM\FluentLLM;
use FluentLLM\FluentLLMServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use RefreshDatabase;

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
