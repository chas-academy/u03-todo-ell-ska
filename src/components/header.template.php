<header class="header">
  <div>
    <?php if ($this->back) : ?>
      <button id="back" class="back">
        <span>go back</span>
        <?php
        $icon = new Icon('chevron-left', 24);
        $icon->render();
        ?>
      </button>
    <?php endif; ?>
    <?php
    if (isset($this->icon)) {
      $icon = new Icon($this->icon, 24);
      $icon->render();
    }
    ?>
    <?php if (isset($this->list)) : ?>
      <h1><?= $this->list ?></h1>
    <?php endif; ?>
  </div>
  <button id="open-sidebar">
    <span>open menu</span>
    <?php
    $icon = new Icon('menu', 24);
    $icon->render();
    ?>
  </button>
</header>