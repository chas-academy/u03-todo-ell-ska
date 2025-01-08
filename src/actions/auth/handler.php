<?php
require_once __DIR__ . '/log-out.php';
require_once __DIR__ . '/delete.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['action'])) {
    die('Action is required');
  }

  switch ($_POST['action']) {
    case 'log-out':
      logOut();
      break;
    case 'delete':
      deleteUser();
      break;
  }
}
