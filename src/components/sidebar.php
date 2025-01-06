<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/menu-item.php';
class Sidebar {
  private $staticMenuItems;
  private $dynamicMenuItems = [];

  public function __construct() {
    $db = Database::getInstance();
    $user = Auth::getUser();

    $query = $db->prepare("SELECT * FROM lists WHERE user_id = :id");
    $query->execute(['id' => $user['id']]);
    $lists = $query->fetchAll();

    foreach ($lists as $list) {
      $this->dynamicMenuItems[] = new MenuItem($list['name'], '/list.php?id=' . $list['id'], null);
    }

    $this->staticMenuItems = [
      new MenuItem('Inbox', '/', 'inbox'),
      new MenuItem('Today', '/today.php', 'calendar'),
      new MenuItem('Done', '/done.php', 'check')
    ];
  }

  public function render() {
    require __DIR__ . '/sidebar.template.php';
  }
}
