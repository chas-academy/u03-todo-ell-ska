<div class="profile-menu-container">
    <button id="open-<?= $this->location ?>-profile-menu" class="open-profile-menu">
        <?php require __DIR__ . '/profile-picture.php' ?>
        <span>Open profile menu</span>
    </button>
    <?php require __DIR__ . '/profile-menu.php' ?>
</div>