<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../lib/auth.php';
require_once __DIR__ . '/../../utils/navigation.php';
require_once __DIR__ . '/../../utils/validation.php';

function logOut() {
  sessionStartUnlessStarted();

  unset($_SESSION['user_id']);
  unset($_SESSION['username']);

  redirect('/log-in.php');
}
