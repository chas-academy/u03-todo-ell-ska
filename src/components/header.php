<?php
require_once 'components/icon.php';

class Header {
  private string $list;
  private ?string $icon;

  public function __construct(string $list, ?string $icon) {
    $this->list = $list;
    $this->icon = $icon;
  }

  public function render() {
    require 'components/header.template.php';
  }
}
