<?php

use App\Components\Icon;

?>

<a class="menu-item" href="<?= $this->href ?>">
    <?php
    if (isset($this->icon)) {
        Icon::render(['type' => $this->icon, 'size' => 16]);
    }
    ?>
    <span><?= $this->name ?></span>
</a>