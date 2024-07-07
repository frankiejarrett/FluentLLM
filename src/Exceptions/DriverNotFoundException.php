<?php

namespace FluentLLM\Exceptions;

class DriverNotFoundException extends \Exception
{
    public function __construct(string $driver)
    {
        parent::__construct("Driver [{$driver}] not found.");
    }
}
