<?php
namespace Azrael\CMS\Component;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Azrael\CMS\Config\General as GeneralConfig;

class ApiController extends \Azrael\Routing\Controller
{
    public function __construct($baseUri = null)
    {
        parent::__construct($baseUri);
    }

    /**
     * Dies and displays JSON data.
     *
     * @param object $data      Object to encode into JSON
     * @param integer $status   HTTP Status Code
     * @return void
     */
    public function outputJSON(object $data, int $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        die(json_encode($data));
    }
}
