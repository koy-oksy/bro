<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class Image extends BaseController
{

    protected $helpers = ['config', 'parser', 'filesystem'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
    }
    
    public function index($image_date, $image_name): string
    {
        $path = sprintf("%suploads" . DIRECTORY_SEPARATOR . "%s" . DIRECTORY_SEPARATOR . "%s", WRITEPATH, $image_date, $image_name);
        $image = fopen($path, 'rb');
        header("Content-Type: image/webp");
        header("Content-Length: " . filesize($path));
        fpassthru($image);
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
                write_file(WRITEPATH . 'uploads' . $src, $file_contents);
                $upd = ['loaded' => 1];
                $keyhash = ['id' => $img['id']];
                $builder->update($upd, $keyhash);
                $processed++;
            } catch (Throwable $e) {
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
