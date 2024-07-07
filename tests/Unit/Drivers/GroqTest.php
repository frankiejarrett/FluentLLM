<?php

use FluentLLM\Drivers\Groq;
use Illuminate\Support\Collection;

it('can send a request to Groq', function () {
    $driver = new Groq(['api_key' => 'test-key']);
    $messages = collect([['role' => 'user', 'content' => 'Hello']]);
    $options = collect(['model' => 'mixtral-8x7b-32768']);

    $response = $driver->sendRequest($messages, $options);

    expect($response)->toBeString();
});
