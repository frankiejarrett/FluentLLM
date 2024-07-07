<?php

use FluentLLM\Facades\LLM;
use FluentLLM\Tests\FakeFluentLLM;

beforeEach(function () {
    LLM::swap(new FakeFluentLLM());
});

it('can send a request', function () {
    $response = LLM::user('Hello')->run();

    expect($response)->toBe('Fake response');
});

it('records sent requests', function () {
    LLM::user('Hello')->run();

    $requests = LLM::getRecordedRequests();
    expect($requests)->toHaveCount(1);
    expect($requests[0]['messages'][0]['content'])->toBe('Hello');
});

it('can set model', function () {
    LLM::model('gpt-4')->user('Hello')->run();

    $requests = LLM::getRecordedRequests();
    expect($requests[0]['options']['model'])->toBe('gpt-4');
});
