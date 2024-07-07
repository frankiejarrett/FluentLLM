<?php

namespace FluentLLM;

use Illuminate\Support\ServiceProvider;

class FluentLLMServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/llm.php', 'llm');

        $this->app->singleton('fluentllm', function ($app) {
            return new FluentLLM($app);
        });

        $this->app->alias('fluentllm', FluentLLM::class);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/llm.php' => config_path('llm.php'),
        ], 'fluentllm-config');
    }
}
