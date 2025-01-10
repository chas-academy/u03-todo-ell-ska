<?php

require_once __DIR__ . '/base-component.php';
require_once __DIR__ . '/../lib/lists.php';
class Sidebar extends BaseComponent
{
    public $staticMenuItems = [
    ['name' => 'Inbox', 'href' => '/', 'icon' => 'inbox'],
    ['name' => 'Today', 'href' => '/today.php', 'icon' => 'calendar'],
    ['name' => 'Done', 'href' => '/done.php', 'icon' => 'check']
    ];
    public $dynamicMenuItems = [];

    public function __construct()
    {
        $lists = Lists::getAll();

        foreach ($lists as $list) {
            $this->dynamicMenuItems[] = ['name' => $list['name'], 'href' => '/list.php?id=' . $list['id'], 'icon' => null];
        }
    }

    protected function getName(): string
    {
        return 'sidebar';
    }
}
