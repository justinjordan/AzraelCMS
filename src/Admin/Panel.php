<?php
namespace Azrael\CMS\Admin;

use Azrael\Structure\Singleton;
use Azrael\CMS\Model\TemplateVariables;
use Azrael\CMS\Model\NavigationItem;

class Panel extends Singleton
{
    /**
     * Gets all admin-side template variables
     * @return array    Returns array of variables.
     */
    public function getTemplateVariables()
    {
        $vars = new TemplateVariables();

        $vars->uri          = $_SERVER['REQUEST_URI'];
        $vars->navigation   = $this->getNavigation();

        return $vars;
    }
    
    /**
     * Gets array of admin panel navigation items
     * @return array
     */
    public function getNavigation()
    {
        $navigation = [];

        $navigation[] = new NavigationItem('/admin', 'Dashboard', 'dashboard');
        $navigation[] = new NavigationItem('/admin/pages', 'Pages', 'description');
        $navigation[] = new NavigationItem('/admin/settings', 'Settings', 'settings');

        return $navigation;
    }
}