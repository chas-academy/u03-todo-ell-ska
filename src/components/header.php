<?php
require_once __DIR__ . '/icon.php';

class Header {
  private string $list;
  private ?string $icon;

  public function __construct(string $list, ?string $icon) {
    $this->list = $list;
    $this->icon = $icon;
  }

  public function render() {
    require_once __DIR__ . '/header.template.php';
  }
}
