<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/redirect.php';
require_once __DIR__ . '/../../utils/validation.php';

function createTask($name, $note, $deadline, $scheduled, $listId) {
  $name = validateString($name, true, 'Task name is required');
  $note = validateString($note);
  $deadline = validateString($deadline);;
  $scheduled = validateString($scheduled);
  $listId = validateString($listId);

  $db = Database::getInstance();
  $user = Auth::getUser();

  if (!$user['id']) {
    redirect('/log-in.php');
  }

  try {
    $query = $db->prepare('INSERT INTO tasks (name, note, deadline, scheduled, list_id, user_id) VALUES (:name, :note, :deadline, :scheduled, :listId, :userId)');
    $query->execute(['name' => $name, 'note' => $note, 'deadline' => $deadline, 'scheduled' => $scheduled, 'listId' => $listId, 'userId' => $user['id']]);

    redirect('/');
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
