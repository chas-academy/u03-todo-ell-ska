<?php

namespace App\Components;

class Header extends BaseComponent
{
    public ?string $title;
    public ?string $icon;
    public ?bool $back;

    public function __construct(array $props)
    {
        $this->title = $props['title'] ?? null;
        $this->icon = $props['icon'] ?? null;
        $this->back = $props['back'] ?? false;
    }

    protected function getName(): string
    {
        return 'header';
    }
}
