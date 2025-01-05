<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/redirect.php';
require_once __DIR__ . '/../../utils/validation.php';

function toggleDone($id) {
  $id = validateString($id, true, 'Task id is required');

  $db = Database::getInstance();
  $user = Auth::getUser();

  if (!$user['id']) {
    redirect('/log-in.php');
  }

  try {
    $query = $db->prepare('UPDATE tasks SET done = !done WHERE id = :id AND user_id = :userId');
    $query->execute(['id' => $id, 'userId' => $user['id']]);

    redirect('/');
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
