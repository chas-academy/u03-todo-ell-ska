<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/redirect.php';
require_once __DIR__ . '/../../utils/validation.php';

function editTask($id, $name, $note, $deadline, $scheduled, $listId) {
  $id = validateString($id, true, 'Task id is required');
  $name = validateString($name, true, 'Task name is required');
  $note = validateString($note);
  $deadline = validateString($deadline);
  $scheduled = validateString($scheduled);
  $listId = validateString($listId);

  $db = Database::getInstance();
  $user = Auth::getUser();

  if (!$user['id']) {
    redirect('/log-in.php');
  }

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

    redirect("/task.php?id=$id");
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
