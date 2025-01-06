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
    return __DIR__ . "/icons/$this->type.template.php";
  }

  private function getTemplate() {
    require $this->getPath();
  }

  public static function render(string $type, int $size) {
    (new self($type, $size))->getTemplate();
  }
}
