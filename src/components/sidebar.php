<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/menu-item.php';

$db = Database::getInstance();
$user = Auth::getUser();

$query = $db->prepare("SELECT * FROM lists WHERE user_id = :id");
$query->execute(['id' => $user['id']]);
$lists = $query->fetchAll();

$dynamicMenuItems = [];
foreach ($lists as $list) {
  array_push($dynamicMenuItems, new MenuItem($list['name'], "/" . strtolower($list['name']), null));
}

$staticMenuItems = [
  new MenuItem('Inbox', '/', 'inbox'),
  new MenuItem('Today', '/today.php', 'calendar'),
  new MenuItem('Done', '/done.php', 'check')
]
?>

<aside class="sidebar">
  <div class="main">
    <header>
      <?php
      require_once __DIR__ . '/logo.php';
      ?>
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
</aside>