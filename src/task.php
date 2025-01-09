<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/navigation.php';
require_once __DIR__ . '/utils/validation.php';
require_once __DIR__ . '/components/sidebar.php';
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/components/task-form-content.php';
require_once __DIR__ . '/components/task-form-options.php';

try {
  if (!isset($_GET['id']) || !validateString($_GET['id'])) {
    throw new Exception('id is invalid');
  }

  $user = Auth::getUser();
  $db = Database::getInstance();

  $query = $db->prepare("SELECT
      tasks.name,
      tasks.note,
      tasks.scheduled,
      tasks.deadline,
      tasks.list_id,
      lists.name AS list_name
    FROM tasks
    LEFT JOIN lists ON tasks.list_id = lists.id
    WHERE tasks.id = :taskId AND tasks.user_id = :userId");
  $query->execute(['taskId' => $_GET['id'], 'userId' => $user['id']]);
  $task = $query->fetch();

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
