<?php
require_once __DIR__ . '/lib/task.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-list.php';
require_once __DIR__ . '/components/icon.php';

$tasks = Task::getToday();

$title = 'Today';
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
