<?php
namespace Azrael\CMS\Config;

use Azrael\Structure\Singleton;

class General extends Singleton
{
    /**
     * Path to src directory
     * @var string
     */
    public $srcDir;

    /**
     * Path to main app directory
     * @var string
     */
    public $appDir;

    /**
     * In development?
     * @var boolean
     */
    public $devMode;

    public function __construct()
    {
        $this->srcDir= dirname(__DIR__);
        $this->appDir= dirname($this->srcDir);
        $this->devMode  = true;
    }
}
