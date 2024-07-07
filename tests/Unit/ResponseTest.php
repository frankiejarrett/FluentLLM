<?php

namespace FluentLLM\Tests\Feature;

use FluentLLM\FluentLLM;
use FluentLLM\Tests\TestCase;

class ResponseTest extends TestCase
{
    protected FluentLLM $llm;

    protected function setUp(): void
    {
        parent::setUp();

        $this->llm = $this->app->make(FluentLLM::class);
    }

    public function test_it_can_handle_custom_responses()
    {
        $response = $this->llm->user('Hello')->run();
        $this->assertNotEmpty($response);
    }

    public function test_it_can_handle_multiple_responses()
    {
        $response1 = $this->llm->user('Hello')->run();
        $this->assertNotEmpty($response1);

        $response2 = $this->llm->user('How are you?')->run();
        $this->assertNotEmpty($response2);
    }
}
