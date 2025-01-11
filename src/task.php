<?php

use App\Components\Header;
use App\Components\TaskFormContent;
use App\Components\TaskFormOptions;

require_once __DIR__ . '/lib/tasks.php';
require_once __DIR__ . '/utils/navigation.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-form-content.php';
require_once __DIR__ . '/components/task-form-options.php';

try {
    $task = Tasks::getById($_GET['id']);

    if (!$task) {
        throw new Exception('task not found');
    }
} catch (Exception $e) {
    redirect('/not-found.php');
}

$title = $task['name'];
ob_start();
?>

<?php Sidebar::render() ?>
<main class="details container">
    <div>
        <?php Header::render(['back' => true]) ?>
        <form action="/actions/tasks.php" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="callback" value="<?= $_SERVER['HTTP_REFERER'] ?>">
            <!-- set default action to edit, this will be triggered on enter -->
            <input type="hidden" name="action" value="edit">
            <div class="main">
                <?php
                TaskFormContent::render(['task' => $task]);
                TaskFormOptions::render(['task' => $task]);
                ?>
            </div>
            <div class="actions">
                <button type="submit" class="delete" name="action" value="delete">Delete</button>
                <button type="submit" class="save">Save</button>
            </div>
        </form>
    </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
