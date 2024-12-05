<a class="menu-item" href="<?= $this->href ?>">
  <?php if (isset($this->icon)) : ?>
    <img src="assets/icons/<?= $this->icon ?>.svg" alt="<?= $this->icon ?> icon" width="16" height="16" />
  <?php endif; ?>
  <span><?= $this->name ?></span>
</a>