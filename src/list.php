<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/task.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/navigation.php';
require_once __DIR__ . '/utils/session-start-unless-started.php';
require_once __DIR__ . '/utils/validation.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-list.php';
require_once __DIR__ . '/components/icon.php';

try {
  $user = Auth::getUser();
  $db = Database::getInstance();

  $listQuery = $db->prepare("SELECT (name) FROM lists WHERE id = :id AND user_id = :userId");
  $listQuery->execute(['id' => $_GET['id'], 'userId' => $user['id']]);
  $list = $listQuery->fetch();

  if (!$list) {
    throw new Exception('list not found');
  }

  $tasks = Task::geList($_GET['id']);
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
    TaskList::render($tasks);

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
