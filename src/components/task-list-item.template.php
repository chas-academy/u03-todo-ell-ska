<li class="task">
  <a href="/task.php?id=<?= $task['id'] ?>">
    <div class="main">
      <form action="/actions/tasks/handler.php" method="post">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <button type="submit" name="action" value="toggle-done" class="checkbox" data-checked="<?= $task['done'] ? 'true' : 'false' ?>">
          <span>mark task as <?= $task['done'] ? 'not done' : 'done' ?></span>
          <?php
          $icon = new Icon('check', 12);
          $icon->render();
          ?>
        </button>
      </form>
      <div class="text">
        <?php if (isset($task['scheduled'])) : ?>
          <time><?= $task['scheduled'] ?></time>
        <?php endif ?>
        <h2><?= $task['name'] ?></h2>
        <?php if (isset($task['list'])) : ?>
          <span><?= $task['list'] ?></span>
        <?php endif ?>
      </div>
    </div>
    <?php if (isset($task['deadline'])) : ?>
      <div class="deadline">
        <?php
        $icon = new Icon('flag', 12);
        $icon->render();
        ?>
        <span>due:</span>
        <time><?= $task['deadline'] ?></time>
      </div>
    <?php endif ?>
  </a>
</li>