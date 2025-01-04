<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/auth.php';
require_once __DIR__ . '/utils/redirect.php';
require_once __DIR__ . '/utils/validation.php';

try {
  if (!isset($_GET['id']) || !validateString($_GET['id'])) {
    throw new Exception('id is invalid');
  }

  $user = Auth::getUser();

  if (!$user) {
    redirect('/log-in.php');
  }

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

<?php require_once __DIR__ . '/components/sidebar.php' ?>
<main class="details container">
  <div>
    <?php
    require_once __DIR__ . '/components/header.php';

    $header = new Header(null, null, true);
    $header->render();
    ?>
    <form action="">
      <div class="main">
        <?php
        require_once __DIR__ . '/components/task-form-content.php';

        $taskFormContent = new TaskFormContent($task);
        $taskFormContent->render();

        require_once __DIR__ . '/components/task-form-options.php';

        $taskFormOptions = new TaskFormOptions($task);
        $taskFormOptions->render();
        ?>
      </div>
      <div class="actions">
        <button class="delete">Delete</button>
        <button type="submit" class="save">Save</button>
      </div>
    </form>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
