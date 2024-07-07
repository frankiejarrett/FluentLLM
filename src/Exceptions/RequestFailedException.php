<?php

namespace FluentLLM\Exceptions;

class RequestFailedException extends \Exception
{
    public function __construct(string $message, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct("Request failed: {$message}", $code, $previous);
    }
}
