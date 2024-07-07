<?php

namespace FluentLLM\Tests\Feature;

use FluentLLM\FluentLLM;
use FluentLLM\Tests\TestCase;

class RequestTest extends TestCase
{
    protected FluentLLM $llm;

    protected function setUp(): void
    {
        parent::setUp();

        $this->llm = new FluentLLM($this->app);
    }

    public function test_it_can_send_a_request()
    {
        $response = $this->llm->user('Hello')->run();
        $this->assertNotEmpty($response);
    }

    public function test_it_records_sent_requests()
    {
        $this->llm->user('Hello')->run();
        // Implement a way to check recorded requests
        $this->assertTrue(true); // Placeholder assertion
    }

    public function test_it_can_set_model()
    {
        $this->llm->model('gpt-4')->user('Hello')->run();
        // Implement a way to check if the model was set correctly
        $this->assertTrue(true); // Placeholder assertion
    }
}
