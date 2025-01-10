<?php

require_once __DIR__ . '/base-component.php';

enum Location
{
    case HEADER;
    case SIDEBAR;
}

class OpenProfileMenu extends BaseComponent
{
    public $location;

    public function __construct(array $props)
    {
        $this->location = $props['location'] === Location::HEADER ? 'header' : 'sidebar';
    }

    protected function getName(): string
    {
        return 'open-profile-menu';
    }
}
