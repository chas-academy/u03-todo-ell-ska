<?php require_once __DIR__ . '/icon.php' ?>

<form action="/actions/lists.php" method="post">
  <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
  <button name="action" value="delete" class="delete-list-button">
    <?php Icon::render('circle-x', 16) ?>
    <span>Delete list</span>
  </button>
</form>