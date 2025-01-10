<?php

require_once __DIR__ . '/base-component.php';
class MenuItem extends BaseComponent
{
    public string $name;
    public string $href;
    public ?string $icon;

    public function __construct(array $props)
    {
        $this->name = $props['name'];
        $this->href = $props['href'];
        $this->icon = $props['icon'] ?? null;
    }

    protected function getName(): string
    {
        return 'menu-item';
    }
}
