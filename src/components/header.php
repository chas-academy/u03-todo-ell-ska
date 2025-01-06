<?php
require_once __DIR__ . '/icon.php';

class Header {
  private ?string $list;
  private ?string $icon;
  private ?bool $back;

  public function __construct(?string $list, ?string $icon = null, ?bool $back = false) {
    $this->list = $list;
    $this->icon = $icon;
    $this->back = $back;
  }

  private function getTemplate() {
    require_once __DIR__ . '/header.template.php';
  }

  public static function render(?string $list, ?string $icon = null, ?bool $back = false) {
    (new self($list, $icon, $back))->getTemplate();
  }
}
