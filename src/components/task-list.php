<?php
class TaskList {
  private $tasks;

  public function __construct($tasks) {
    $this->tasks = $tasks;
  }

  public function render() {
    require __DIR__ . '/task-list.template.php';
  }
}
