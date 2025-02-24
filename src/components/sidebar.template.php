<?php

use App\Components\OpenProfileMenu;
use App\Components\MenuItem;
use App\Components\Icon;

require_once __DIR__ . '/open-profile-menu.php';
require_once __DIR__ . '/menu-item.php';
require_once __DIR__ . '/icon.php';
?>

<aside id="sidebar" class="sidebar hidden">
    <div class="main">
        <header>
            <?php require_once __DIR__ . '/logo.php' ?>
            <button id="close-sidebar">
                <span>close menu</span>
                <?php Icon::render(['type' => 'x', 'size' => 24]) ?>
            </button>
        </header>
        <nav>
            <div class="static-menu-items">
                <?php
                foreach ($this->staticMenuItems as $item) {
                    MenuItem::render($item);
                }
                ?>
            </div>
            <div class="separator"></div>
            <div class="dynamic-menu-items">
                <?php
                foreach ($this->dynamicMenuItems as $item) {
                    MenuItem::render($item);
                }
                ?>
            </div>
        </nav>
    </div>
    <div class="buttons">
        <button id="open-add-list-modal">
            <?php Icon::render(['type' => 'plus', 'size' => 16]) ?>
            <span>New list</span>
        </button>
        <?php OpenProfileMenu::render(['location' => 'sidebar']) ?>
    </div>
</aside>