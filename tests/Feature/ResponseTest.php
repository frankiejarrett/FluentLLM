<?php

use FluentLLM\Facades\LLM;
use FluentLLM\Tests\FakeFluentLLM;

beforeEach(function () {
    LLM::swap(new FakeFluentLLM());
});

it('can handle custom responses', function () {
    $expectedResponse = 'Custom response';
    LLM::expectResponse($expectedResponse);

    $response = LLM::user('Hello')->run();

    expect($response)->toBe($expectedResponse);
});

it('can handle multiple responses', function () {
    LLM::expectResponse('Response 1')
        ->expectResponse('Response 2');

    $response1 = LLM::user('Hello')->run();
    $response2 = LLM::user('How are you?')->run();

    expect($response1)->toBe('Response 1');
    expect($response2)->toBe('Response 2');
});
