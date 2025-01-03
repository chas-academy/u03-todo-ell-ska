<?php
require_once __DIR__ . '/session-start-unless-started.php';
require_once __DIR__ . '/../components/icon.php';

sessionStartUnlessStarted();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

if ($error) :
?>
  <div class="error">
    <?php
    $icon = new Icon('circle-alert', 16);
    $icon->render();
    ?>
    <p><?= $error ?></p>
  </div>
<?php endif ?>