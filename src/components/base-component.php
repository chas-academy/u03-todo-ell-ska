<?php

namespace App\Components;

abstract class BaseComponent
{
    abstract protected function getName(): string;

    protected function getTemplate()
    {
        $name = $this->getName();
        require $_SERVER['DOCUMENT_ROOT'] . "/components/$name.template.php";
    }

    public static function render(?array $params = null)
    {
        $class = get_called_class();
        $instance = new $class($params);
        $instance->getTemplate();
    }
}
