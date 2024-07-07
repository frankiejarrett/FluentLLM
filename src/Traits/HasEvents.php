<?php

namespace FluentLLM\Traits;

use Illuminate\Support\Facades\Event;

trait HasEvents
{
    protected array $events = [];

    public function on(string $event, callable $callback): self
    {
        $this->events[$event] = $callback;

        return $this;
    }

    protected function fireEvent(string $event, mixed ...$params): void
    {
        $eventClass = "FluentLLM\\Events\\{$event}";

        if (class_exists($eventClass)) {
            Event::dispatch(new $eventClass(...$params));
        }

        if (isset($this->events[$event]) && is_callable($this->events[$event])) {
            call_user_func_array($this->events[$event], $params);
        }
    }
}
