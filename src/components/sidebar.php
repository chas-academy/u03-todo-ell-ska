<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../lib/auth.php';
class Sidebar {
  private $staticMenuItems = [
    ['Inbox', '/', 'inbox'],
    ['Today', '/today.php', 'calendar'],
    ['Done', '/done.php', 'check']
  ];
  private $dynamicMenuItems = [];

  public function __construct() {
    $db = Database::getInstance();
    $user = Auth::getUser();

    $query = $db->prepare("SELECT * FROM lists WHERE user_id = :id");
    $query->execute(['id' => $user['id']]);
    $lists = $query->fetchAll();

    foreach ($lists as $list) {
      $this->dynamicMenuItems[] = [$list['name'], '/list.php?id=' . $list['id'], null];
    }
  }

  private function getTemplate() {
    require __DIR__ . '/sidebar.template.php';
  }

  public static function render() {
    (new self())->getTemplate();
  }
}
