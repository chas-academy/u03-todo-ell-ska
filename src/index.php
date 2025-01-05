<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/redirect.php';
require_once __DIR__ . '/utils/session-start-unless-started.php';
require_once __DIR__ . '/components/icon.php';

sessionStartUnlessStarted();
$user = Auth::getUser();

if (!$user) {
  redirect('/log-in.php');
}

$db = Database::getInstance();

$query = $db->prepare("SELECT * FROM tasks WHERE user_id = :id AND list_id IS NULL");
$query->execute(['id' => $user['id']]);
$tasks = $query->fetchAll();

$title = 'Inbox';
ob_start();
?>

<?php require_once __DIR__ . '/components/sidebar.php' ?>
<main class="list container">
  <div>
    <?php
    require_once __DIR__ . '/components/header.php';

    $header = new Header('Inbox', 'inbox');
    $header->render();
    ?>

    <ul>
      <?php foreach ($tasks as $task) : ?>
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
      <?php endforeach; ?>
    </ul>

    <?php
    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
require_once __DIR__ . '/components/add-task-modal.php';

$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
