<?php
namespace Azrael\CMS\Controller;

use Azrael\CMS\Admin\Panel;
use Azrael\CMS\Component\Controller;

class AdminSide extends Controller
{
    public function index($args)
    {
        $variables = Panel::instance()->getTemplateVariables();
        return self::getTemplate('dashboard.twig', $variables);
    }
}
