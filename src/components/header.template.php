<header class="header">
  <div>
    <?php
    if (isset($this->icon)) {
      $icon = new Icon($this->icon, 24);
      $icon->render();
    }
    ?>
    <h1><?= $this->list ?></h1>
  </div>
  <button>
    <span>open menu</span>
    <?php
    $icon = new Icon('menu', 24);
    $icon->render();
    ?>
  </button>
</header>