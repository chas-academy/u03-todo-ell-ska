<?php
require_once 'lib/auth.php';
require_once 'utils/redirect.php';
require_once 'utils/session-start-unless-started.php';

sessionStartUnlessStarted();
if (!Auth::getUser()) {
  redirect('/log-in.php');
}

$title = 'Inbox';
ob_start();
?>

<?php require_once 'components/sidebar.php' ?>
<main class="list">
  <header>
    <button>
      <img src="assets/icons/chevron-left.svg" />
    </button>
    <div>
      <img src="assets/icons/inbox.svg" alt="inbox icon" width="24" height="24" />
      <h1>Inbox</h1>
    </div>
  </header>
</main>

<?php
$content = ob_get_clean();
require 'layout.php';
