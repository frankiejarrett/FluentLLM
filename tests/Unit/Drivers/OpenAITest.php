<?php

use FluentLLM\Drivers\OpenAI;
use Illuminate\Support\Collection;

it('can send a request to OpenAI', function () {
    $driver = new OpenAI(['api_key' => 'test-key']);
    $messages = collect([['role' => 'user', 'content' => 'Hello']]);
    $options = collect(['model' => 'gpt-3.5-turbo']);

    $response = $driver->sendRequest($messages, $options);

    expect($response)->toBeString();
});
