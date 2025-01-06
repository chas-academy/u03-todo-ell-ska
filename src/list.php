<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/navigation.php';
require_once __DIR__ . '/utils/session-start-unless-started.php';
require_once __DIR__ . '/utils/validation.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/icon.php';

try {
  if (!isset($_GET['id']) || !validateString($_GET['id'])) {
    throw new Exception('id is invalid');
  }

  $user = Auth::getUser();

  if (!$user) {
    redirect('/log-in.php');
  }

  $db = Database::getInstance();

  $listQuery = $db->prepare("SELECT (name) FROM lists WHERE id = :id AND user_id = :userId");
  $listQuery->execute(['id' => $_GET['id'], 'userId' => $user['id']]);
  $list = $listQuery->fetch();

  if (!$list) {
    throw new Exception('list not found');
  }

  $tasksQuery = $db->prepare("
    SELECT *
    FROM tasks
    WHERE user_id = :userId
      AND list_id = :listId
      AND done = 0
    ORDER BY
      CASE 
        WHEN deadline IS NULL THEN 1 
        ELSE 0 
      END ASC, 
      deadline ASC,
      CASE 
        WHEN scheduled IS NULL THEN 1 
        ELSE 0 
      END ASC, 
      scheduled ASC,
      created_at DESC
  ");
  $tasksQuery->execute(['userId' => $user['id'], 'listId' => $_GET['id']]);
  $tasks = $tasksQuery->fetchAll();
} catch (Exception $e) {
  redirect('/not-found.php');
}

$title = $list['name'];
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
  <div>
    <?php
    Header::render($list['name']);

    require_once __DIR__ . '/components/task-list.php';

    $taskList = new TaskList($tasks);
    $taskList->render();

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
