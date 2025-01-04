<?php
class TaskFormContent {
  private $task;

  public function __construct($task = null) {
    $this->task = $task;
  }

  public function render() {
    require __DIR__ . '/task-form-content.template.php';
  }
}
