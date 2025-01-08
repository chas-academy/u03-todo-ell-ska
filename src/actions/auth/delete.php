<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/navigation.php';
require_once __DIR__ . '/../../utils/validation.php';

function deleteUser() {
  $db = Database::getInstance();
  $user = Auth::getUser();

  if (!$user['id']) {
    redirect('/log-in.php');
  }

  try {
    $query = $db->prepare('DELETE FROM users WHERE id = :id');
    $query->execute(['id' => $user['id']]);

    redirect('/sign-up.php');
  } catch (PDOException $error) {
    die($error->getMessage());
  }
}
