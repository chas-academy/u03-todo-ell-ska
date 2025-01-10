<?php

use App\Components\Icon;

?>

<form action="/actions/lists.php" method="post">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <button name="action" value="delete" class="delete-list-button">
        <?php Icon::render(['type' => 'circle-x', 'size' => 16]) ?>
        <span>Delete list</span>
    </button>
</form>