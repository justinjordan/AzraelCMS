<?php
namespace Azrael\CMS\Controller;

use Azrael\Routing\Controller;
use Twig_Environment;
use Twig_Loader_Filesystem;

class AdminSide extends Controller
{
    protected function init()
    {
        $srcDir = dirname(__DIR__);
        $appDir = dirname($srcDir);

        /** Setup Twig */
        $loader = new Twig_Loader_Filesystem("$srcDir/templates");
        $this->twig = new Twig_Environment($loader, array(
            // 'cache' => "$appDir/cache",
        ));
    }

    public function index($args)
    {
        $template = $this->twig->load('dashboard.html');
        return $template->render([
            'args'  => $args
        ]);
    }
}
