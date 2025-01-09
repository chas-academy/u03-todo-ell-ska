<?php
require_once __DIR__ . '/../lib/tasks.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['action'])) {
    die('Action is required');
  }

  switch ($_POST['action']) {
    case 'create':
      Tasks::create($_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['done'], $_POST['list']);
      break;
    case 'toggle-done':
      Tasks::toggleDone($_POST['id']);
      break;
    case 'edit':
      Tasks::edit($_POST['id'], $_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['list'], $_POST['callback']);
      break;
    case 'delete':
      Tasks::delete($_POST['id']);
      break;
  }
}
