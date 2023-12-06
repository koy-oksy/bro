<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class Image extends BaseController
{

    protected $helpers = ['config', 'parser', 'filesystem', 'page'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
    }
    
    public function index($image_date, $image_name): string
    {
        $path = sprintf(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . $image_date . DIRECTORY_SEPARATOR . $image_name);
        drop_image_into_browser($path);
        exit;
    }
    
    public function vertical($image_date, $image_name): string
    {
        $image_name = 'vertical_' . $image_name;
        $path = sprintf(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . $image_date . DIRECTORY_SEPARATOR . $image_name);
        drop_image_into_browser($path);
        exit;
    }
    
    public function horizontal($image_date, $image_name): string
    {
        $image_name = 'horizontal_' . $image_name;
        $path = sprintf(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . $image_date . DIRECTORY_SEPARATOR . $image_name);
        drop_image_into_browser($path);
        exit;
    }
    
    public function getstatus() {
        $request = \Config\Services::request();
        $hike_id = $request->getGet('hike_id');
        if (!$hike_id) {
            $data = [
                'status' => 'error',
                'message' => 'hike_id missed',
            ];
            return $this->response->setJSON($data);
        }
        $db = \Config\Database::connect();
        $builder = $db->table('images-to-load');
        $output = $builder->where(['hike_id' => $hike_id])->get();
        $download = $output->getResultArray();
        return $this->response->setJSON($download);
    }
    
    public function processQueue() {
        $db = \Config\Database::connect();
        $builder = $db->table('images-to-load');
        $output = $builder->where(['loaded' => 0])->get();
        $download = $output->getResultArray();
        $processed = 0;
        $failed = 0;
        $errors = [];
        foreach ($download as $img) {
            try {
                $src = $img['download_src'];
                $file_contents = file_get_contents("https://telegra.ph" . $src);
                $dir = WRITEPATH . 'uploads';
                write_file($dir . $src, $file_contents);
                // copy file and resize
                $image = \Config\Services::image();
                
                $image->withFile($dir . $src) 
                    ->fit(510, 703, 'center') 
                    ->save($dir . modify_image_name($src, 'vertical_'));
                
                $image->withFile($dir . $src) 
                    ->fit(510, 340, 'center') 
                    ->save($dir . modify_image_name($src, 'horizontal_'));
                
                $upd = ['loaded' => 1];
                $keyhash = ['id' => $img['id']];
                $builder->update($upd, $keyhash);
                $processed++;
            } catch (\Throwable $e) {
                $errors[] = $e->getMessage();
                $failed++;
            }
        }
        echo "<p>Processed: $processed</p>";
        echo "<p>Failed: $failed</p>";
        if ($errors) {
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
        return true;
    }
    
}
