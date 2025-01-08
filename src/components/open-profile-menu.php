<?php

enum Location {
  case HEADER;
  case SIDEBAR;
}
class OpenProfileMenu {
  private $location;

  public function __construct(Location $location) {
    $this->location = $location === Location::HEADER ? 'header' : 'sidebar';
  }

  private function getTemplate() {
    require __DIR__ . '/open-profile-menu.template.php';
  }

  public static function render(Location $location) {
    (new self($location))->getTemplate();
  }
}
