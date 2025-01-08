<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/navigation.php';
require_once __DIR__ . '/utils/session-start-unless-started.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-list.php';
require_once __DIR__ . '/components/icon.php';

$user = Auth::getUser();
$db = Database::getInstance();

$query = $db->prepare("
  SELECT
    tasks.id,
    tasks.name,
    tasks.note,
    tasks.done,
    tasks.scheduled,
    tasks.deadline,
    lists.name AS list
  FROM tasks
  LEFT JOIN lists ON tasks.list_id = lists.id
  WHERE tasks.user_id = :id
    AND done = 1
  ORDER BY tasks.created_at DESC
");
$query->execute(['id' => $user['id']]);
$tasks = $query->fetchAll();

$title = 'Done';
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
  <div>
    <?php
    Header::render('Done', 'check');
    TaskList::render($tasks);

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
