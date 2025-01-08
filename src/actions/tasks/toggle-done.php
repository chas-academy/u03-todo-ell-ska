<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/navigation.php';
require_once __DIR__ . '/../../utils/validation.php';

function toggleDone($id) {
  $id = validateString($id, true, 'Task id is required');

  $user = Auth::getUser();
  $db = Database::getInstance();

  try {
    $query = $db->prepare('UPDATE tasks SET done = !done WHERE id = :id AND user_id = :userId');
    $query->execute(['id' => $id, 'userId' => $user['id']]);

    refresh();
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
