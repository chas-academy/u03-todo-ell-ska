<?php
require_once 'db.php';
require_once 'lib/auth.php';
require_once 'lib/mutations.php';
require_once 'components/icon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  createTask($_POST['name'], $_POST['note'], $_POST['deadline'], $_POST['scheduled'], $_POST['list']);
}

$db = Database::getInstance();
$user = Auth::getUser();

$query = $db->prepare("SELECT name, id FROM lists WHERE user_id = :id");
$query->execute(['id' => $user['id']]);
$lists = $query->fetchAll();
?>

<div id="add-task-overlay" class="overlay hidden"></div>
<div id="add-task-modal" class="modal hidden">
  <form method="post">
    <div class="content">
      <label for="name">Task name</label>
      <input type="text" name="name" id="name" placeholder="New task" required>
      <label for="note">Task notes</label>
      <textarea name="note" id="note" placeholder="Notes"></textarea>
    </div>
    <div class="tools">
      <div class="options">
        <div class="dropdown">
          <label for="list">Task list</label>
          <select name="list" id="list">
            <option value="">No list</option>
            <?php foreach ($lists as $list) : ?>
              <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
            <?php endforeach; ?>
          </select>
          <button>
            <?php
            $icon = new Icon('list', 16);
            $icon->render();
            ?>
            <span id="list-preview" class="hidden"></span>
          </button>
        </div>
        <div class="date-picker">
          <label for="scheduled">Scheduled date</label>
          <input type="date" name="scheduled" id="scheduled">
          <button type="button">
            <?php
            $icon = new Icon('calendar', 16);
            $icon->render();
            ?>
            <span id="scheduled-preview" class="hidden"></span>
          </button>
        </div>
        <div class="date-picker">
          <label for="deadline">Deadline</label>
          <input type="date" name="deadline" id="deadline">
          <button type="button">
            <?php
            $icon = new Icon('flag', 16);
            $icon->render();
            ?>
            <span id="deadline-preview" class="hidden"></span>
          </button>
        </div>
      </div>
      <button type="submit">
        <span>Add task</span>
        <?php
        $icon = new Icon('check', 24);
        $icon->render();
        ?>
      </button>
    </div>
  </form>
</div>