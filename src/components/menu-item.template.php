<a class="menu-item" href="<?= $this->href ?>">
  <?php
  if (isset($this->icon)) {
    Icon::render($this->icon, 16);
  }
  ?>
  <span><?= $this->name ?></span>
</a>