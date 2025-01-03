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

  $query = $db->prepare("SELECT * FROM tasks WHERE id = :taskId AND user_id = :userId");
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
<main class="details">
  <div>
    <?= $task['name'] ?>
  </div>
</main>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layout.php';
