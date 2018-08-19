<?php
namespace Azrael\CMS\Component;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Azrael\CMS\Config\General as GeneralConfig;

class Controller extends \Azrael\Routing\Controller
{
    protected $templateVariables = [];
    protected static $twig;

    public function __construct($baseUri = null)
    {
        parent::__construct($baseUri);

        /**
         * Setup Twig
         */
        if (self::$twig === null) {
            $srcDir = GeneralConfig::instance()->srcDir;
            $appDir = GeneralConfig::instance()->appDir;

            $loader = new Twig_Loader_Filesystem("$srcDir/templates");
            $opts = [];

            if (!GeneralConfig::instance()->devMode) {
                $opts['cache'] = "$appDir/cache";
            }

            self::$twig = new Twig_Environment($loader, $opts);
        }
    }

    public static function getTemplate(string $template, object $vars = null)
    {
        $vars = (array)$vars;
        $template = self::$twig->load($template);
        return $template->render($vars);
    }
}
