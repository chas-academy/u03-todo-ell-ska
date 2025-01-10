<?php

use App\Controllers\Tasks;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\TaskList;

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
