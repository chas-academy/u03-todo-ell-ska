<?php

class Check {
  private string $size;

  public function __construct(string $size) {
    $this->size = $size;
  }

  public function render() {
    require 'components/icons/check.template.php';
  }
}
