<?php

use App\Controllers\Tasks;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\TaskList;

$tasks = Tasks::getDone();

$title = 'Done';
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
    <div>
        <?php
        Header::render(['title' => 'Done', 'icon' => 'check']);
        TaskList::render(['tasks' => $tasks]);

        require_once __DIR__ . '/components/open-add-task-modal.php';
        ?>
    </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
