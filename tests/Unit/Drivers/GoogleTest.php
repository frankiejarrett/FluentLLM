<?php

use FluentLLM\Drivers\Google;
use Illuminate\Support\Collection;

it('can send a request to Google', function () {
    $driver = new Google(['api_key' => 'test-key']);
    $messages = collect([['role' => 'user', 'content' => 'Hello']]);
    $options = collect(['model' => 'chat-bison']);

    $response = $driver->sendRequest($messages, $options);

    expect($response)->toBeString();
});
