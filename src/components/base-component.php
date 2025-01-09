<?php

abstract class BaseComponent {
  abstract protected function getName(): string;

  protected function getTemplate() {
    $name = $this->getName();
    require_once __DIR__ . "/$name.template.php";
  }

  public static function render(array $params) {
    $class = get_called_class();
    $instance = new $class($params);
    $instance->getTemplate();
  }
}
