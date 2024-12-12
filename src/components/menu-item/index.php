<?php

class MenuItem {
  private string $name;
  private string $href;
  private ?string $icon;

  public function __construct(string $name, string $href, ?string $icon) {
    $this->name = $name;
    $this->href = $href;
    $this->icon = $icon;
  }

  public function render() {
    require 'components/menu-item/template.php';
  }
}
