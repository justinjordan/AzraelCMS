<?php
namespace Azrael\CMS\Controller\AdminSide;

use Azrael\CMS\Component\Controller;
use Azrael\CMS\Admin\Panel;

class Pages extends Controller
{
    public function index()
    {
        $variables = Panel::instance()->getTemplateVariables();
        return self::getTemplate('pages.twig', $variables);
    }
}