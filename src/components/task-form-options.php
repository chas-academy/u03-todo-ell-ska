<?php

namespace App\Components;

class TaskFormOptions extends BaseComponent
{
    public $task;

    public function __construct(array|null $props)
    {
        $this->task = $props['task'] ?? null;
    }

    protected function getName(): string
    {
        return 'task-form-options';
    }
}
