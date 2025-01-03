<div id="add-task-overlay" class="overlay hidden"></div>
<div id="add-task-modal" class="task-modal modal hidden">
  <form action="/actions/tasks/create.php" method="post">
    <?php
    require_once __DIR__ . '/task-form-content.php';
    ?>
    <div class="tools">
      <?php
      require_once __DIR__ . '/task-form-options.php';
      ?>
      <button type="submit">
        <span>Add task</span>
        <?php
        $icon = new Icon('check', 24);
        $icon->render();
        ?>
      </button>
    </div>
  </form>
</div>