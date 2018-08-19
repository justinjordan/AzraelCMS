<?php
namespace Azrael\CMS;

use Azrael\Routing\Router;
use Azrael\Routing\Controller;
use Azrael\CMS\Controller\AdminSide;
use Azrael\CMS\Controller\PublicSide;
use Azrael\Hooks;

class CMS
{
    public function start()
    {
        Router::route([
            '/admin/*'  => AdminSide::instance('/admin'),
            '*'         => PublicSide::instance('/'),
        ]);
    }
}
