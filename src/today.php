<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/navigation.php';
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
    AND done = 0
    AND (deadline IS NOT NULL AND deadline <= CURRENT_DATE)
    OR (scheduled IS NOT NULL AND scheduled <= CURRENT_DATE)
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

<?php
require_once __DIR__ . '/components/sidebar.php';

$sidebar = new Sidebar();
$sidebar->render();
?>
<main class="list container">
  <div>
    <?php
    require_once __DIR__ . '/components/header.php';

    $header = new Header('Today', 'calendar');
    $header->render();

    require_once __DIR__ . '/components/task-list.php';

    $taskList = new TaskList($tasks, true);
    $taskList->render();

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
