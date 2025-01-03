<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/icon.php';

$db = Database::getInstance();
$user = Auth::getUser();

$query = $db->prepare("SELECT name, id FROM lists WHERE user_id = :id");
$query->execute(['id' => $user['id']]);
$lists = $query->fetchAll();
?>


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