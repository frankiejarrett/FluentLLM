<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default LLM Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default LLM driver that will be used to send
    | requests. You may set this to any of the drivers defined in the
    | "drivers" array below.
    |
    */

    'default' => env('LLM_DRIVER', 'openai'),

    /*
    |--------------------------------------------------------------------------
    | LLM Drivers
    |--------------------------------------------------------------------------
    |
    | Here you may configure the LLM drivers for your application. Each driver
    | can have its own specific configuration options.
    |
    */

    'drivers' => [
        'openai' => [
            'api_key' => env('OPENAI_API_KEY'),
            'organization' => env('OPENAI_ORGANIZATION'),
            'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
        ],
        'anthropic' => [
            'api_key' => env('ANTHROPIC_API_KEY'),
            'model' => env('ANTHROPIC_MODEL', 'claude-2'),
        ],
        'google' => [
            'api_key' => env('GOOGLE_API_KEY'),
            'model' => env('GOOGLE_MODEL', 'chat-bison'),
        ],
        'groq' => [
            'api_key' => env('GROQ_API_KEY'),
            'model' => env('GROQ_MODEL', 'mixtral-8x7b-32768'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Retry Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the retry behavior for failed LLM requests.
    |
    */

    'retry' => [
        'max_attempts' => env('LLM_RETRY_MAX_ATTEMPTS', 3),
        'initial_interval' => env('LLM_RETRY_INITIAL_INTERVAL', 1000), // milliseconds
        'interval_multiplier' => env('LLM_RETRY_INTERVAL_MULTIPLIER', 2),
        'max_interval' => env('LLM_RETRY_MAX_INTERVAL', 10000), // milliseconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Fallback Configuration
    |--------------------------------------------------------------------------
    |
    | Configure fallback behavior when the primary driver fails.
    |
    */

    'fallback' => [
        'enabled' => env('LLM_FALLBACK_ENABLED', true),
        'drivers' => ['openai', 'anthropic', 'google', 'groq'],
    ],
];
