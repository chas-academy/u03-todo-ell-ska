<?php
require_once __DIR__ . '/../lib/lists.php';
class Sidebar {
  private $staticMenuItems = [
    ['name' => 'Inbox', 'href' => '/', 'icon' => 'inbox'],
    ['name' => 'Today', 'href' => '/today.php', 'icon' => 'calendar'],
    ['name' => 'Done', 'href' => '/done.php', 'icon' => 'check']
  ];
  private $dynamicMenuItems = [];

  public function __construct() {
    $lists = Lists::getAll();

    foreach ($lists as $list) {
      $this->dynamicMenuItems[] = ['name' => $list['name'], 'href' => '/list.php?id=' . $list['id'], 'icon' => null];
    }
  }

  private function getTemplate() {
    require __DIR__ . '/sidebar.template.php';
  }

  public static function render() {
    (new self())->getTemplate();
  }
}
