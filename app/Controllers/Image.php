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
    
    public function index($image_date, $image_name): string
    {
        $path = sprintf("%suploads/%s/%s", WRITEPATH, $image_date, $image_name);
        $image = fopen($path, 'rb');
        header("Content-Type: image/webp");
        header("Content-Length: " . filesize($path));
        fpassthru($image);
        exit;
    }
    
}
