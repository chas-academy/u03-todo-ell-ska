<?php require_once __DIR__ . '/icon.php' ?>

<div id="<?= $this->location ?>-profile-menu" class="profile-menu hidden">
    <form action="/actions/auth.php" method="post">
        <button name="action" value="log-out">
            <?php Icon::render(['type' => 'log-out', 'size' => 16]) ?>
            <span>Log out</span>
        </button>
        <button name="action" value="delete">
            <?php Icon::render(['type' => 'circle-x', 'size' => 16]) ?>
            <span>Delete account</span>
        </button>
    </form>
</div>