<?php

namespace App;

use App\Models\NavigationItem;

class AdminPanel
{
    public $navigation = [];

    public function __construct()
    {
        $this->navigation = $this->getNavigation();
    }

    /**
     * Gets array of admin panel navigation items
     * @return array
     */
    public function getNavigation()
    {
        $navigation = [];

        $navigation[] = new NavigationItem('/admin/dashboard', 'Dashboard', 'dashboard');
        $navigation[] = new NavigationItem('/admin/pages', 'Pages', 'description');
        $navigation[] = new NavigationItem('/admin/settings', 'Settings', 'settings');

        return $navigation;
    }
}
