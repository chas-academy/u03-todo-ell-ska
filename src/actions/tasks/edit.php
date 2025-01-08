<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/navigation.php';
require_once __DIR__ . '/../../utils/validation.php';

function editTask($id, $name, $note, $deadline, $scheduled, $listId, $callback = null) {
  $id = validateString($id, true, 'Task id is required');
  $name = validateString($name, true, 'Task name is required');
  $note = validateString($note);
  $deadline = validateString($deadline);
  $scheduled = validateString($scheduled);
  $listId = validateString($listId);
  $callback = validateString($callback);

  $user = Auth::getUser();
  $db = Database::getInstance();

  try {
    $query = $db->prepare('UPDATE tasks
      SET
        name = :name,
        note = :note,
        deadline = :deadline,
        scheduled = :scheduled,
        list_id = :listId
      WHERE id = :id AND user_id = :userId');
    $query->execute(['name' => $name, 'note' => $note, 'deadline' => $deadline, 'scheduled' => $scheduled, 'listId' => $listId, 'id' => $id, 'userId' => $user['id']]);

    if ($callback) {
      redirect($callback);
    } else {
      redirect('/');
    }
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
