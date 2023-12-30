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
    
    public function processimage($image_id) {
        $error = '';
        $db = \Config\Database::connect();
        $builder = $db->table('images-to-load');
        $where = [
            'id' => $image_id,
        ];
        $output = $builder->where($where)->get();
        $img = $output->getRowArray();
        if (!$img['loaded']) {
            try {
                $src = $img['download_src'];
                $imageModel = new \App\Models\ImageModel();
                $orientation = $imageModel->downloadImage($src);
                $builder->update([
                    'loaded' => 1,
                    'orientation' => $orientation,
                ], ['id' => $img['id']]);
            } catch (\Throwable $e) {
                $error = $e->getMessage();
            }
        }
        $response = [
            'src' => $src,
            'vertical' => modify_image_name_url($src, 'vertical_'),
            'horizontal' => modify_image_name_url($src, 'horizontal_'),
            'error' => $error,
        ];
        return $this->response->setJSON($response);
    }
    
    public function processdynamicimage($image_id) {
        $error = '';
        $db = \Config\Database::connect();
        $builder = $db->table('dynamic-images-to-load');
        $where = [
            'id' => $image_id,
        ];
        $output = $builder->where($where)->get();
        $img = $output->getRowArray();
        if (!$img['loaded']) {
            try {
                $src = $img['download_src'];
                $imageModel = new \App\Models\ImageModel();
                $orientation = $imageModel->downloadImage($src);
                $builder->update([
                    'loaded' => 1,
                    'orientation' => $orientation,
                ], ['id' => $img['id']]);
            } catch (\Throwable $e) {
                $error = $e->getMessage();
            }
        }
        $response = [
            'src' => $src,
            'vertical' => modify_image_name_url($src, 'vertical_'),
            'horizontal' => modify_image_name_url($src, 'horizontal_'),
            'error' => $error,
        ];
        return $this->response->setJSON($response);
    }
    
    public function processqueue() {
        $db = \Config\Database::connect();
        $builder = $db->table('images-to-load');
        $where = ['loaded' => 0];
        $output = $builder->where($where)->get();
        $download = $output->getResultArray();
        $processed = 0;
        $failed = 0;
        $errors = [];
        foreach ($download as $img) {
            try {
                $src = $img['download_src'];
                $imageModel = new \App\Models\ImageModel();
                $imageModel->downloadImage($src);
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
