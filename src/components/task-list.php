<?php
class TaskList {
  private $tasks = [];
  private $overdueTasks = [];

  public function __construct($tasks, bool $separateOverdueTasks = false) {
    if ($separateOverdueTasks) {
      foreach ($tasks as $task) {
        $today = date('Y-m-d');

        if ($task['deadline'] === $today || $task['scheduled'] === $today) {
          $this->tasks[] = $task;
        } else {
          $this->overdueTasks[] = $task;
        }
      }
    } else {
      $this->tasks = $tasks;
    }
  }

  private function getTemplate() {
    require __DIR__ . '/task-list.template.php';
  }

  public static function render($tasks, bool $separateOverdueTasks = false) {
    (new self($tasks, $separateOverdueTasks))->getTemplate();
  }
}
