<?php

use App\Components\Icon;

require_once __DIR__ . '/icon.php'

?>

<button id="open-add-task-modal">
    <span>open add task modal</span>
    <?php Icon::render(['type' => 'plus', 'size' => 24]) ?>
</button>