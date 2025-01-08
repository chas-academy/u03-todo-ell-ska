<?php require_once __DIR__ . '/icon.php' ?>

<div id="<?= $this->location ?>-profile-menu" class="profile-menu hidden">
  <form action="" method="post">
    <button>
      <?php Icon::render('log-out', 16) ?>
      <span>Log out</span>
    </button>
    <button>
      <?php Icon::render('circle-x', 16) ?>
      <span>Delete account</span>
    </button>
  </form>
</div>