<?php
require_once __DIR__ . '/lib/task.php';
require_once __DIR__ . '/lib/lists.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-list.php';
require_once __DIR__ . '/components/icon.php';

try {
  $name = Lists::getName($_GET['id']);

  if (!$name) {
    throw new Exception('list not found');
  }

  $tasks = Task::geList($_GET['id']);
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
    Header::render($name);
    TaskList::render($tasks);

    require_once __DIR__ . '/components/open-add-task-modal.php';
    ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
