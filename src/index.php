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
  SELECT *
  FROM tasks
  WHERE user_id = :id
    AND list_id IS NULL
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
$query->execute(['id' => $user['id']]);
$tasks = $query->fetchAll();

$title = 'Inbox';
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
  <div>
    <?php
    Header::render('Inbox', 'inbox');
    TaskList::render($tasks);

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
