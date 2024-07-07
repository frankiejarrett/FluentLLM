<?php

use FluentLLM\Drivers\OpenAI;
use Illuminate\Support\Collection;

it('can send a request to OpenAI', function () {
    $driver = new OpenAI(['api_key' => 'test-key']);
    $messages = new Collection([['role' => 'user', 'content' => 'Hello']]);
    $options = new Collection(['model' => 'gpt-3.5-turbo']);

    $response = $driver->sendRequest($messages, $options);

    expect($response)->toBeString();
});
