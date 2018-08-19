<?php

namespace App\Models;

class NavigationItem
{
    public $href;
    public $label;
    public $icon;

    public function __construct($href, $label = null, $icon = null)
    {
        $this->href = $href;
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * @return boolean  Returns true if active, or false.
     */
    public function isActive()
    {
        if (strpos($_SERVER['REQUEST_URI'], $this->href) !== 0) {
            return false;
        }

        return true;
    }
}
