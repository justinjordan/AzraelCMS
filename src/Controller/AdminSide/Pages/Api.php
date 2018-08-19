<?php
namespace Azrael\CMS\Controller\AdminSide\Pages;

use Azrael\CMS\Component\ApiController;

class Api extends ApiController
{
    public function index()
    {
        $output = (object)[
            'success'   => false,
            'error'     => "Endpoint not found.",
        ];

        $this->outputJSON($output, 404);
    }

    public function getPages()
    {
        $pages = [];

        $data = (object)[
            'success'   => true,
            'data'      => [
                'pages'     => $pages
            ]
        ];
        $this->outputJSON($data);
    }
}