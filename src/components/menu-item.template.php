<a class="menu-item" href="<?= $this->href ?>">
  <?php
  if (isset($this->icon)) {
    require_once 'components/icon.php';

    $icon = new Icon($this->icon, 16);
    $icon->render();
  }
  ?>
  <span><?= $this->name ?></span>
</a>