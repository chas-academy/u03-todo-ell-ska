<?php
require_once __DIR__ . '/../lib/task.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['action'])) {
    die('Action is required');
  }

  switch ($_POST['action']) {
    case 'create':
      Task::create($_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['done'], $_POST['list']);
      break;
    case 'toggle-done':
      Task::toggleDone($_POST['id']);
      break;
    case 'edit':
      Task::edit($_POST['id'], $_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['list'], $_POST['callback']);
      break;
    case 'delete':
      Task::delete($_POST['id']);
      break;
  }
}
