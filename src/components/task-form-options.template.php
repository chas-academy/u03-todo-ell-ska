<?php

use App\Components\Icon;

require_once __DIR__ . '/../lib/lists.php';
require_once __DIR__ . '/../utils/date.php';
require_once __DIR__ . '/icon.php';

$lists = Lists::getAll();

function prefillToday(string|null $date, bool $relative = false)
{
    if (isset($date)) {
        return $date;
    }

    if (str_contains($_SERVER['REQUEST_URI'], 'today.php')) {
        return $relative ? getRelativeDate(date('Y-m-d')) : date('Y-m-d');
    }

    return '';
}

function prefillListId(string|null $listId, string|null $taskListId)
{
    if ((isset($taskListId) && $listId === $taskListId) || str_contains($_SERVER['REQUEST_URI'], $listId)) {
        return 'selected';
    }

    return '';
}

function prefillListName(string|null $taskListName, $lists)
{
    if ($taskListName) {
        return $taskListName;
    }

    if (str_contains($_SERVER['REQUEST_URI'], 'list.php') && isset($_GET['id'])) {
        $list = array_search($_GET['id'], array_column($lists, 'id'));
        return $lists[$list]['name'];
    }

    return '';
}
?>

<div class="options">
    <div class="dropdown">
        <label for="list">Task list</label>
        <select name="list" id="list">
            <option value="">No list</option>
            <?php foreach ($lists as $list) : ?>
                <option
                    value="<?= $list['id'] ?>"
                    <?= prefillListId($list['id'] ?? null, $this->task['list_id'] ?? null) ?>>
                    <?= $list['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button>
            <?php Icon::render(['type' => 'list', 'size' => 16]) ?>
            <span
                id="list-preview"
                class="<?= prefillListName($this->task['list_name'] ?? null, $lists) ? 'visible' : 'hidden' ?>">
                <?= prefillListName($this->task['list_name'] ?? null, $lists) ?>
            </span>
        </button>
    </div>
    <div class="date-picker">
        <label for="scheduled">Scheduled date</label>
        <input
            type="date"
            name="scheduled"
            id="scheduled"
            value="<?= prefillToday($this->task['scheduled'] ?? null) ?>">
        <button type="button">
            <?php Icon::render(['type' => 'calendar', 'size' => 16]) ?>
            <span
                id="scheduled-preview"
                class="<?= prefillToday($this->task['scheduled'] ?? null) ? 'visible' : 'hidden' ?>">
                <?= prefillToday($this->task['scheduled'] ?? null, true) ?>
            </span>
        </button>
    </div>
    <div class="date-picker">
        <label for="deadline">Deadline</label>
        <input
            type="date"
            name="deadline"
            id="deadline"
            value="<?= isset($this->task['deadline']) ? $this->task['deadline'] : '' ?>">
        <button type="button">
            <?php Icon::render(['type' => 'flag', 'size' => 16]) ?>
            <span
                id="deadline-preview"
                class="<?= isset($this->task['deadline']) ? 'visible' : 'hidden' ?>">
                <?= isset($this->task['deadline']) ? getRelativeDate($this->task['deadline']) : '' ?>
            </span>
        </button>
    </div>
</div>