<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Image extends BaseController
{

    protected $helpers = ['config'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
    }
    
    public function index($image_type, $image_name): string
    {
        switch ($image_type) {
            case 'uploads':
                $path = WRITEPATH . 'uploads/';
                break;
            default:
                $path = base_url('img');
        }
        $image = file_get_contents($path . $image_name);
        header("Content-Type: image/webp");
        header("Content-Length: " . filesize($path . $image_name));
        echo $image;
        return true;
    }
    
}
