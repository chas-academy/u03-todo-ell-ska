<?php
require_once __DIR__ . '/open-profile-menu.php';
require_once __DIR__ . '/icon.php';
?>

<header class="header">
    <div class="start">
        <?php if ($this->back) : ?>
            <button id="back" class="back">
                <span>go back</span>
                <?php Icon::render(['type' => 'chevron-left', 'size' => 24]) ?>
            </button>
        <?php endif; ?>
        <?php
        if (isset($this->icon)) {
            Icon::render(['type' => $this->icon, 'size' => 24]);
        }
        ?>
        <?php if (isset($this->title)) : ?>
            <h1><?= $this->title ?></h1>
        <?php endif; ?>
    </div>
    <button id="open-sidebar">
        <span>open menu</span>
        <?php Icon::render(['type' => 'menu', 'size' => 24]) ?>
    </button>
    <div class="end">
        <?php
        if (str_contains($_SERVER['REQUEST_URI'], 'list.php')) {
            require __DIR__ . '/delete-list.php';
        }

        OpenProfileMenu::render(['location' => 'header']);
        ?>
    </div>
</header>