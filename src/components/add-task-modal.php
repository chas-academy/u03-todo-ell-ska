<?php
require_once __DIR__ . '/task-form-content.php';
require_once __DIR__ . '/task-form-options.php';
?>

<div id="add-task-modal" class="task-modal modal hidden">
  <form action="/actions/tasks.php" method="post">
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="done" value="<?= str_contains($_SERVER['REQUEST_URI'], 'done.php') ?>">
    <?php TaskFormContent::render() ?>
    <div class="tools">
      <?php TaskFormOptions::render() ?>
      <button type="submit">
        <span>Add task</span>
        <?php Icon::render(['type' => 'check', 'size' => 24]) ?>
      </button>
    </div>
  </form>
</div>