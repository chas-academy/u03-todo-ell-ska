<?php
require_once 'utils/redirect.php';
require_once 'utils/session-start-unless-started.php';

sessionStartUnlessStarted();
if (!Auth::getUser()) {
  redirect('/log-in.php');
}

$title = 'Inbox';
ob_start();
?>
<?php require_once './components/sidebar.php' ?>
<?php
$content = ob_get_clean();
require 'layout.php';
