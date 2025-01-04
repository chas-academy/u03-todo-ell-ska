<?php
require_once __DIR__ . '/icon.php';

class Header {
  private ?string $list;
  private ?string $icon;
  private ?bool $back;

  public function __construct(?string $list, ?string $icon, ?bool $back = false) {
    $this->list = $list;
    $this->icon = $icon;
    $this->back = $back;
  }

  public function render() {
    require_once __DIR__ . '/header.template.php';
  }
}
