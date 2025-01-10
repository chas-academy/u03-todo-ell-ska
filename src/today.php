<?php
require_once __DIR__ . '/lib/tasks.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-list.php';
require_once __DIR__ . '/components/icon.php';

$tasks = Tasks::getToday();

$title = 'Today';
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
    <div>
        <?php
        Header::render(['title' => 'Today', 'icon' => 'calendar']);
        TaskList::render(['tasks' => $tasks, 'separate-overdue-tasks' => true]);

        require_once __DIR__ . '/components/open-add-task-modal.php';
        ?>
    </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
