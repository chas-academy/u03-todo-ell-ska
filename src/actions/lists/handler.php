<?php
require_once __DIR__ . '/create.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['action'])) {
    die('Action is required');
  }

  switch ($_POST['action']) {
    case 'create':
      createList($_POST['name']);
      break;
  }
}
