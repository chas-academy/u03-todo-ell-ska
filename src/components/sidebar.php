<?php
require_once __DIR__ . '/../lib/lists.php';
class Sidebar {
  private $staticMenuItems = [
    ['Inbox', '/', 'inbox'],
    ['Today', '/today.php', 'calendar'],
    ['Done', '/done.php', 'check']
  ];
  private $dynamicMenuItems = [];

  public function __construct() {
    $lists = Lists::getAll();

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
