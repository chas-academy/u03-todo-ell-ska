<?php
require_once 'db.php';
require_once 'lib/auth.php';
require_once 'utils/redirect.php';
require_once 'utils/session-start-unless-started.php';
require 'components/icon.php';

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

<?php require_once 'components/sidebar.php' ?>
<main class="list">
  <div>
    <?php
    require_once 'components/header.php';

    $header = new Header('Inbox', 'inbox');
    $header->render();
    ?>

    <ul>
      <?php foreach ($tasks as $task) : ?>
        <li class="task">
          <div class="main">
            <div class="checkbox">
              <label for="done">task finished</label>
              <input type="checkbox" name="done" id="done" <?= $task['done'] ? 'checked' : '' ?>>
              <?php
              $icon = new Icon('check', 12);
              $icon->render();
              ?>
            </div>
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
        </li>
      <?php endforeach; ?>
    </ul>

    <button id="open-add-task-modal">
      <?php
      $icon = new Icon('plus', 24);
      $icon->render();
      ?>
    </button>
  </div>
</main>

<?php
require_once 'components/add-task-modal.php';

$content = ob_get_clean();
require 'layout.php';
