<?php

use App\Components\Icon;

require_once __DIR__ . '/../utils/date.php';
require_once __DIR__ . '/icon.php';

?>

<li class="task">
    <a href="/task.php?id=<?= $task['id'] ?>">
        <div class="main">
            <form action="/actions/tasks.php" method="post">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <input type="hidden" name="action" value="toggle-done">
                <button type="submit" class="checkbox" data-checked="<?= $task['done'] ? 'true' : 'false' ?>">
                    <span>mark task as <?= $task['done'] ? 'not done' : 'done' ?></span>
                    <?php Icon::render(['type' => 'check', 'size' => 12]) ?>
                </button>
            </form>
            <div class="text">
                <?php if (isset($task['scheduled'])) : ?>
                    <time><?= getRelativeDate($task['scheduled']) ?></time>
                <?php endif ?>
                <h2><?= $task['name'] ?></h2>
                <?php if (isset($task['list'])) : ?>
                    <span><?= $task['list'] ?></span>
                <?php endif ?>
            </div>
        </div>
        <?php if (isset($task['deadline'])) : ?>
            <div class="deadline">
                <?php Icon::render(['type' => 'flag', 'size' => 12]) ?>
                <span>due:</span>
                <time><?= getRelativeDate($task['deadline']) ?></time>
            </div>
        <?php endif ?>
    </a>
</li>