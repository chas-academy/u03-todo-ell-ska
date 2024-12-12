<?php
require_once 'db.php';
require_once 'lib/auth.php';
require_once 'utils/redirect.php';
require_once 'utils/session-start-unless-started.php';

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
  <header>
    <button>
      <img src="assets/icons/chevron-left.svg" />
    </button>
    <div>
      <img src="assets/icons/inbox.svg" alt="inbox icon" width="24" height="24" />
      <h1>Inbox</h1>
    </div>
  </header>

  <ul>
    <?php foreach ($tasks as $task) : ?>
      <li class="task">
        <div class="main">
          <div class="checkbox">
            <label for="done">task finished</label>
            <input type="checkbox" name="done" id="done" <?= $task['done'] ? 'checked' : '' ?>>
            <?php
            require_once 'components/icons/check.php';

            $icon = new Check(12);
            $icon->render();
            ?>
          </div>
          <div class="text">
            <?php if (isset($task['when'])) : ?>
              <time><?= $task['when'] ?></time>
            <?php endif ?>
            <h2><?= $task['name'] ?></h2>
            <?php if (isset($task['list'])) : ?>
              <span><?= $task['list'] ?></span>
            <?php endif ?>
          </div>
        </div>
        <?php if (isset($task['deadline'])) : ?>
          <div class="deadline">
            <img src="assets/icons/flag.svg" alt="flag icon" width="12" height="12" />
            <span>due:</span>
            <time><?= $task['deadline'] ?></time>
          </div>
        <?php endif ?>
      </li>
    <?php endforeach; ?>
  </ul>
</main>

<?php
$content = ob_get_clean();
require 'layout.php';
