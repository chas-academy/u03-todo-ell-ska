<?php

class Icon {
  private string $type;
  private int $size;
  private int $strokeWidth = 2;

  public function __construct(string $type, int $size) {
    $this->type = $type;
    $this->size = $size;
  }

  private function getPath() {
    return "components/icons/$this->type.template.php";
  }

  public function render() {
    $path = $this->getPath();
    require $path;
  }
}
