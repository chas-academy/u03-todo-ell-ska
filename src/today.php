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
    AND done = 0
    AND (
          (deadline IS NOT NULL AND deadline <= CURRENT_DATE)
          OR (scheduled IS NOT NULL AND scheduled <= CURRENT_DATE)
        )
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
    scheduled ASC
");
$query->execute(['id' => $user['id']]);
$tasks = $query->fetchAll();

$title = 'Inbox';
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
  <div>
    <?php
    Header::render('Today', 'calendar');
    TaskList::render($tasks, true);

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
