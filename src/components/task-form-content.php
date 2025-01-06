<?php
class TaskFormContent {
  private $task;

  public function __construct($task = null) {
    $this->task = $task;
  }

  private function getTemplate() {
    require __DIR__ . '/task-form-content.template.php';
  }

  public static function render($task = null) {
    (new self($task))->getTemplate();
  }
}
