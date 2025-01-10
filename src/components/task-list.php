<?php

namespace App\Components;

class TaskList extends BaseComponent
{
    public $tasks = [];
    public $overdueTasks = [];

    public function __construct(array $props)
    {
        if ($props['separate-overdue-tasks'] ?? false) {
            foreach ($props['tasks'] as $task) {
                $today = date('Y-m-d');

                if ($task['deadline'] === $today || $task['scheduled'] === $today) {
                    $this->tasks[] = $task;
                } else {
                    $this->overdueTasks[] = $task;
                }
            }
        } else {
            $this->tasks = $props['tasks'];
        }
    }

    protected function getName(): string
    {
        return 'task-list';
    }
}
