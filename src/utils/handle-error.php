<?php
require_once 'utils/session-start-unless-started.php';

sessionStartUnlessStarted();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

if ($error) :
?>
  <div class="error">
    <img src="assets/icons/circle-alert.svg" alt="alert icon" width="16" height="16" />
    <p><?= $error ?></p>
  </div>
<?php endif ?>