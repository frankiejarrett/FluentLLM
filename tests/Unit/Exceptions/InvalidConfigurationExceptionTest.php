<?php

namespace FluentLLM\Tests\Unit\Exceptions;

use FluentLLM\Exceptions\InvalidConfigurationException;
use FluentLLM\Tests\TestCase;

class InvalidConfigurationExceptionTest extends TestCase
{
    public function test_invalid_configuration_exception()
    {
        $exception = new InvalidConfigurationException('Missing API key');
        $this->assertEquals('Invalid configuration: Missing API key', $exception->getMessage());
    }
}
