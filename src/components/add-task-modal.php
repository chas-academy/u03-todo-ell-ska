<div id="add-task-overlay" class="overlay hidden"></div>
<div id="add-task-modal" class="task-modal modal hidden">
  <form action="/actions/tasks/handler.php" method="post">
    <?php
    require_once __DIR__ . '/task-form-content.php';
    $taskFormContent = new TaskFormContent();
    $taskFormContent->render();
    ?>
    <div class="tools">
      <?php
      require_once __DIR__ . '/task-form-options.php';
      $taskFormOptions = new TaskFormOptions();
      $taskFormOptions->render();
      ?>
      <button type="submit" name="action" value="create">
        <span>Add task</span>
        <?php Icon::render('check', 24) ?>
      </button>
    </div>
  </form>
</div>