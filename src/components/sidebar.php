<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/menu-item.php';
require_once __DIR__ . '/icon.php';

$db = Database::getInstance();
$user = Auth::getUser();

$query = $db->prepare("SELECT * FROM lists WHERE user_id = :id");
$query->execute(['id' => $user['id']]);
$lists = $query->fetchAll();

$dynamicMenuItems = [];
foreach ($lists as $list) {
  array_push($dynamicMenuItems, new MenuItem($list['name'], '/list.php?id=' . $list['id'], null));
}

$staticMenuItems = [
  new MenuItem('Inbox', '/', 'inbox'),
  new MenuItem('Today', '/today.php', 'calendar'),
  new MenuItem('Done', '/done.php', 'check')
]
?>

<aside id="sidebar" class="sidebar hidden">
  <div class="main">
    <header>
      <?php
      require_once __DIR__ . '/logo.php';
      ?>

      <button id="close-sidebar">
        <span>close menu</span>
        <?php
        $icon = new Icon('x', 24);
        $icon->render();
        ?>
      </button>
    </header>
    <nav>
      <div class="static-menu-items">
        <?php
        foreach ($staticMenuItems as $item) {
          $item->render();
        }
        ?>
      </div>
      <div class="separator"></div>
      <div class="dynamic-menu-items">
        <?php
        foreach ($dynamicMenuItems as $item) {
          $item->render();
        }
        ?>
      </div>
    </nav>
  </div>
  <button id="open-add-list-modal">
    <?php
    $icon = new Icon('plus', 16);
    $icon->render();
    ?>
    <span>New list</span>
  </button>
</aside>