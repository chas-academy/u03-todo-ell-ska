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

  <ul>
    <li class="task">
      <div class="main">
        <div class="checkbox">
          <label>done</label>
          <input type="checkbox">
          <?php
          require_once 'components/icons/check.php';

          $icon = new Check(12);
          $icon->render();
          ?>
        </div>
        <div>
          <time>when</time>
          <h2>label</h2>
          <span>list</span>
        </div>
      </div>
      <div class="deadline">
        <img src="assets/icons/flag.svg" alt="flag icon" width="12" height="12" />
        <span>due:</span>
        <time>deadline</time>
      </div>
    </li>
  </ul>
</main>

<?php
$content = ob_get_clean();
require 'layout.php';
