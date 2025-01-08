<header class="header">
  <div>
    <?php if ($this->back) : ?>
      <button id="back" class="back">
        <span>go back</span>
        <?php Icon::render('chevron-left', 24) ?>
      </button>
    <?php endif; ?>
    <?php
    if (isset($this->icon)) {
      Icon::render($this->icon, 24);
    }
    ?>
    <?php if (isset($this->list)) : ?>
      <h1><?= $this->list ?></h1>
    <?php endif; ?>
  </div>
  <button id="open-sidebar">
    <span>open menu</span>
    <?php Icon::render('menu', 24) ?>
  </button>
  <?php require __DIR__ . '/open-profile-menu.php' ?>
</header>