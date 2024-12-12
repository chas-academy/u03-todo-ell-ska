<?php
require_once 'db.php';
require_once 'lib/auth.php';
require_once 'components/menu-item/index.php';

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
  new MenuItem('Inbox', '/inbox', 'inbox'),
  new MenuItem('Today', '/today', 'calendar'),
  new MenuItem('Done', '/done', 'check')
]
?>

<aside>
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
</aside>