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
    <div class="inputs">
      <div>
        <label for="name">Task name</label>
        <input type="text" name="name" id="name" placeholder="New task" required>
      </div>
      <div>
        <label for="note">Task notes</label>
        <textarea name="note" id="note" placeholder="Notes"></textarea>
      </div>
    </div>
    <div class="tools">
      <div class="options">
        <div class="dropdown">
          <button>
            <?php
            $icon = new Icon('list', 16);
            $icon->render();
            ?>
            <span>List</span>
          </button>
          <select name="list" id="list">
            <option value="">No list</option>
            <?php foreach ($lists as $list) : ?>
              <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="date-picker">
          <button type="button" id="open-scheduled-input">
            <?php
            $icon = new Icon('calendar', 16);
            $icon->render();
            ?>
            <span>Scheduled</span>
          </button>
          <input type="date" name="scheduled" id="scheduled">
        </div>
        <div class="date-picker">
          <button type="button" id="open-deadline-input">
            <?php
            $icon = new Icon('flag', 16);
            $icon->render();
            ?>
            <span>Deadline</span>
          </button>
          <input type="date" name="deadline" id="deadline">
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