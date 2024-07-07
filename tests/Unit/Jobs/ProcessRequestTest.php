<?php

namespace FluentLLM\Tests\Unit\Jobs;

use FluentLLM\FluentLLM;
use FluentLLM\Jobs\ProcessRequest;
use FluentLLM\Tests\TestCase;
use Illuminate\Support\Collection;
use Mockery;

class ProcessRequestTest extends TestCase
{
    public function test_process_request_job_handles_correctly()
    {
        $messages = collect([['role' => 'user', 'content' => 'Test message']]);
        $options = collect(['model' => 'gpt-3.5-turbo']);

        $mockDriver = Mockery::mock('FluentLLM\Contracts\Driver');
        $mockDriver->shouldReceive('sendRequest')
            ->with($messages, $options)
            ->once()
            ->andReturn('Test response');

        $mockLLM = Mockery::mock(FluentLLM::class);
        $mockLLM->shouldReceive('driver')->andReturn($mockDriver);

        $job = new ProcessRequest($messages, $options);
        $result = $job->handle($mockLLM);

        $this->assertEquals('Test response', $result);
    }
}
