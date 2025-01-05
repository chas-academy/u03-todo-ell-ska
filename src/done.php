<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/redirect.php';
require_once __DIR__ . '/utils/session-start-unless-started.php';
require_once __DIR__ . '/components/icon.php';

$user = Auth::getUser();

if (!$user) {
  redirect('/log-in.php');
}

$db = Database::getInstance();

$query = $db->prepare("
  SELECT *
  FROM tasks
  WHERE user_id = :id
    AND done = 1
  ORDER BY created_at DESC
");
$query->execute(['id' => $user['id']]);
$tasks = $query->fetchAll();

$title = 'Done';
ob_start();
?>

<?php require_once __DIR__ . '/components/sidebar.php' ?>
<main class="list container">
  <div>
    <?php
    require_once __DIR__ . '/components/header.php';

    $header = new Header('Done', 'check');
    $header->render();

    require_once __DIR__ . '/components/task-list.php';

    $taskList = new TaskList($tasks);
    $taskList->render();

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
require_once __DIR__ . '/components/add-task-modal.php';

$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
