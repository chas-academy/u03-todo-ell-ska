<?php
require_once __DIR__ . '/menu-item.php';
require_once __DIR__ . '/icon.php';
?>

<aside id="sidebar" class="sidebar hidden">
  <div class="main">
    <header>
      <?php
      require_once __DIR__ . '/logo.php';
      ?>

      <button id="close-sidebar">
        <span>close menu</span>
        <?php Icon::render('x', 24) ?>
      </button>
    </header>
    <nav>
      <div class="static-menu-items">
        <?php
        foreach ($this->staticMenuItems as $item) {
          MenuItem::render($item[0], $item[1], $item[2]);
        }
        ?>
      </div>
      <div class="separator"></div>
      <div class="dynamic-menu-items">
        <?php
        foreach ($this->dynamicMenuItems as $item) {
          MenuItem::render($item[0], $item[1], $item[2]);
        }
        ?>
      </div>
    </nav>
  </div>
  <button id="open-add-list-modal">
    <?php Icon::render('plus', 16) ?>
    <span>New list</span>
  </button>
</aside>