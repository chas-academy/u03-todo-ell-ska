<?php

use App\Controllers\Tasks;
use App\Controllers\Lists;
use App\Components\Sidebar;
use App\Components\Header;
use App\Components\TaskList;

require_once __DIR__ . '/controllers/tasks.php';
require_once __DIR__ . '/controllers/lists.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-list.php';

try {
    $name = Lists::getName($_GET['id']);

    if (!$name) {
        throw new Exception('list not found');
    }

    $tasks = Tasks::geList($_GET['id']);
} catch (Exception $e) {
    redirect('/not-found.php');
}

$title = $name;
ob_start();
?>

<?php Sidebar::render() ?>
<main class="list container">
    <div>
        <?php
        Header::render(['title' => $name]);
        TaskList::render(['tasks' => $tasks]);
        ?>
        <div class="actions">
            <?php
            require __DIR__ . '/components/delete-list.php';
            require_once __DIR__ . '/components/open-add-task-modal.php';
            ?>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
