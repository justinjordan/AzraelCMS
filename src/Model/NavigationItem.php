<?php
namespace Azrael\CMS\Model;

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
}