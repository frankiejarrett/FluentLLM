<?php

namespace FluentLLM\Exceptions;

class InvalidConfigurationException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct("Invalid configuration: {$message}");
    }
}
