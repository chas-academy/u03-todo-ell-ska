<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/navigation.php';
require_once __DIR__ . '/../../utils/validation.php';

function createList($name) {
  $name = validateString($name, true, 'List name is required');

  $db = Database::getInstance();
  $user = Auth::getUser();

  if (!$user['id']) {
    redirect('/log-in.php');
  }

  try {
    $query = $db->prepare('INSERT INTO lists (name, user_id) VALUES (:name, :userId) RETURNING id');
    $query->execute(['name' => $name, 'userId' => $user['id']]);

    $id = $query->fetchColumn();

    redirect("/list.php?id=$id");
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
