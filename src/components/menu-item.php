<?php
require_once __DIR__ . '/icon.php';

class MenuItem {
  private string $name;
  private string $href;
  private ?string $icon;

  public function __construct(string $name, string $href, ?string $icon) {
    $this->name = $name;
    $this->href = $href;
    $this->icon = $icon;
  }

  private function getTemplate() {
    require __DIR__ . '/menu-item.template.php';
  }

  public static function render(string $name, string $href, ?string $icon) {
    (new self($name, $href, $icon))->getTemplate();
  }
}
