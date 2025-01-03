<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/redirect.php';
require_once __DIR__ . '/../../utils/validation.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = validateString($_POST['name'], true, 'Task name is required');
  $note = validateString($_POST['note']);
  $deadline = validateString($_POST['deadline']);
  $scheduled = validateString($_POST['scheduled']);
  $listId = validateString($_POST['list']);

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
