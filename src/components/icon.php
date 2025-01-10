<?php

namespace App\Components;

class Icon extends BaseComponent
{
    public string $type;
    public int $size;
    public int $strokeWidth = 2;

    public function __construct(array $props)
    {
        $this->type = $props['type'];
        $this->size = $props['size'];
    }

    protected function getName(): string
    {
        return "/icons/$this->type";
    }
}
