<?php
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
        <?php
        $icon = new Icon('x', 24);
        $icon->render();
        ?>
      </button>
    </header>
    <nav>
      <div class="static-menu-items">
        <?php
        foreach ($this->staticMenuItems as $item) {
          $item->render();
        }
        ?>
      </div>
      <div class="separator"></div>
      <div class="dynamic-menu-items">
        <?php
        foreach ($this->dynamicMenuItems as $item) {
          $item->render();
        }
        ?>
      </div>
    </nav>
  </div>
  <button id="open-add-list-modal">
    <?php
    $icon = new Icon('plus', 16);
    $icon->render();
    ?>
    <span>New list</span>
  </button>
</aside>