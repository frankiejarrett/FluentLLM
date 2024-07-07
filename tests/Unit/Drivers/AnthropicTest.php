<?php

use FluentLLM\Drivers\Anthropic;
use Illuminate\Support\Collection;

it('can send a request to Anthropic', function () {
    $driver = new Anthropic(['api_key' => 'test-key']);
    $messages = new Collection([['role' => 'user', 'content' => 'Hello']]);
    $options = new Collection(['model' => 'claude-2']);

    $response = $driver->sendRequest($messages, $options);

    expect($response)->toBeString();
});
