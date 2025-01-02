<?php
require_once 'components/icon.php';
?>

<div id="add-task-overlay" class="overlay hidden"></div>
<div id="add-task-modal" class="modal hidden">
  <form action="">
    <div class="inputs">
      <div>
        <label for="name">Task name</label>
        <input type="text" name="name" id="name" placeholder="New task">
      </div>
      <div>
        <label for="note">Task notes</label>
        <input type="text" name="note" id="note" placeholder="Notes">
      </div>
    </div>
    <div class="buttons">
      <div class="options">
        <button>
          <span>List</span>
          <?php
          $icon = new Icon('list', 16);
          $icon->render();
          ?>
        </button>
        <button>
          <span>Scheduled date</span>
          <?php
          $icon = new Icon('calendar', 16);
          $icon->render();
          ?>
        </button>
        <button>
          <span>Deadline</span>
          <?php
          $icon = new Icon('flag', 16);
          $icon->render();
          ?>
        </button>
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