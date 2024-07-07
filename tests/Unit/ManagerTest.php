<?php

namespace FluentLLM\Tests\Unit;

use FluentLLM\FluentLLM;
use FluentLLM\Tests\TestCase;

class ManagerTest extends TestCase
{
    public function test_it_can_create_different_drivers()
    {
        $manager = $this->app->make(FluentLLM::class);

        $openaiDriver = $manager->driver('openai');
        $anthropicDriver = $manager->driver('anthropic');
        $googleDriver = $manager->driver('google');
        $groqDriver = $manager->driver('groq');

        $this->assertInstanceOf(\FluentLLM\Drivers\OpenAI::class, $openaiDriver);
        $this->assertInstanceOf(\FluentLLM\Drivers\Anthropic::class, $anthropicDriver);
        $this->assertInstanceOf(\FluentLLM\Drivers\Google::class, $googleDriver);
        $this->assertInstanceOf(\FluentLLM\Drivers\Groq::class, $groqDriver);
    }

    public function test_it_can_extend_with_custom_drivers()
    {
        $manager = $this->app->make(FluentLLM::class);

        $manager->extend('custom', function ($app) {
            return new class implements \FluentLLM\Contracts\Driver
            {
                public function sendRequest(\Illuminate\Support\Collection $messages, \Illuminate\Support\Collection $options = new \Illuminate\Support\Collection()): mixed
                {
                    return 'Custom driver response';
                }

                public function streamRequest(\Illuminate\Support\Collection $messages, \Illuminate\Support\Collection $options = new \Illuminate\Support\Collection()): \Generator
                {
                    yield 'Custom driver stream';
                }
            };
        });

        $response = $manager->driver('custom')->sendRequest(collect([['role' => 'user', 'content' => 'Hello']]));

        $this->assertEquals('Custom driver response', $response);
    }
}
