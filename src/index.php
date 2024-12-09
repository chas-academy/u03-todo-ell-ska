<?php
$title = 'Inbox';
ob_start();
?>
<?php require_once './components/sidebar.php' ?>
<?php
$content = ob_get_clean();
require 'layout.php';
