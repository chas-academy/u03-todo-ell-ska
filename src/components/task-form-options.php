<?php
class TaskFormOptions {
  private $task;

  public function __construct($task = null) {
    $this->task = $task;
  }

  private function getTemplate() {
    require __DIR__ . '/task-form-options.template.php';
  }

  public static function render($task = null) {
    (new self($task))->getTemplate();
  }
}
