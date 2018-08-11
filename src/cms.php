<?php
namespace Azrael\CMS;

use Azrael\Routing\Router;
use Azrael\Routing\Controller;
use Azrael\CMS\Controller\AdminController;
use Azrael\CMS\Controller\PublicController;

class CMS
{
    public function start()
    {
        Router::route([
            '/admin/*'  => new AdminController(),
            '*'         => new PublicController(),
        ]);
    }
}
