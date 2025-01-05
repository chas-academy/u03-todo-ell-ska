<?php
require_once __DIR__ . '/create.php';
require_once __DIR__ . '/edit.php';
require_once __DIR__ . '/delete.php';
require_once __DIR__ . '/toggle-done.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['action'])) {
    die('Action is required');
  }

  switch ($_POST['action']) {
    case 'create':
      createTask($_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['list']);
      break;
    case 'edit':
      editTask($_POST['id'], $_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['list']);
      break;
    case 'delete':
      deleteTask($_POST['id']);
      break;
    case 'toggle-done':
      toggleDone($_POST['id']);
      break;
  }
}
