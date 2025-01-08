<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/navigation.php';
require_once __DIR__ . '/../../utils/validation.php';

function createTask($name, $note, $deadline, $scheduled, $listId, $done) {
  $name = validateString($name, true, 'Task name is required');
  $note = validateString($note);
  $deadline = validateString($deadline);;
  $scheduled = validateString($scheduled);
  $listId = validateString($listId);
  $done = validateString($done) ?? '0';

  $user = Auth::getUser();
  $db = Database::getInstance();

  try {
    $query = $db->prepare('INSERT INTO tasks (name, note, deadline, scheduled, done, list_id, user_id) VALUES (:name, :note, :deadline, :scheduled, :done, :listId, :userId)');
    $query->execute(['name' => $name, 'note' => $note, 'deadline' => $deadline, 'scheduled' => $scheduled, 'done' => $done, 'listId' => $listId, 'userId' => $user['id']]);

    refresh();
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
