<?php

namespace App\Components;

use Exception;

class OpenProfileMenu extends BaseComponent
{
    public $location;

    public function __construct(array $props)
    {
        $location = $props['location'];
        if ($location !== 'header' && $location !== 'sidebar') {
            throw new Exception("$location is not a valid location");
        }
        $this->location = $location;
    }

    protected function getName(): string
    {
        return 'open-profile-menu';
    }
}
