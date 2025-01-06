<?php
require_once __DIR__ . '/task-form-content.php';
require_once __DIR__ . '/task-form-options.php';
?>

<div id="add-task-overlay" class="overlay hidden"></div>
<div id="add-task-modal" class="task-modal modal hidden">
  <form action="/actions/tasks/handler.php" method="post">
    <?php TaskFormContent::render() ?>
    <div class="tools">
      <?php TaskFormOptions::render() ?>
      <button type="submit" name="action" value="create">
        <span>Add task</span>
        <?php Icon::render('check', 24) ?>
      </button>
    </div>
  </form>
</div>