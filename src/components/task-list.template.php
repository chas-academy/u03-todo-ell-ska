<?php require_once __DIR__ . '/icon.php' ?>

<?php
$hasTasks = isset($this->tasks) && count($this->tasks) !== 0;
$hasOverdueTasks = isset($this->overdueTasks) && count($this->overdueTasks) !== 0;

if ($hasTasks || $hasOverdueTasks) :
    ?>
    <ul>
        <?php
        foreach ($this->tasks as $task) {
            require __DIR__ . '/task-list-item.template.php';
        }
        ?>
        <?php if ($this->overdueTasks) : ?>
            <div class="separator">
                <div></div>
                <p>Overdue</p>
                <div></div>
            </div>
            <?php
            foreach ($this->overdueTasks as $task) {
                require __DIR__ . '/task-list-item.template.php';
            }
        endif;
        ?>
    </ul>
<?php else : ?>
    <div class="empty">
        <h2>All done!</h2>
        <div>
            <p>Enjoy your day</p>
            <?php Icon::render(['type' => 'smile', 'size' => 16]) ?>
        </div>
    </div>
<?php endif ?>