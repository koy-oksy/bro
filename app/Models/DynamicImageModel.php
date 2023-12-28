<?php

namespace App\Models;

use CodeIgniter\Model;

class DynamicImageModel extends Model
{
    protected $table = 'dynamic-images-to-load';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'dynamic_id',
        'download_src',
        'loaded',
    ];
    
    public function getData() {
        return $this->findAll();
    }
    
    public function downloadImage($download_src) {
        $file_contents = file_get_contents("https://telegra.ph" . $download_src);
        $dir = WRITEPATH . 'uploads';
        write_file($dir . $download_src, $file_contents);
        // copy file and resize
        $image = \Config\Services::image();
        $image->withFile($dir . $download_src) 
            ->fit(1100, 1518, 'center') 
            ->save($dir . modify_image_name($download_src, 'vertical_'));
        $image->withFile($dir . $download_src) 
            ->fit(1100, 734, 'center') 
            ->save($dir . modify_image_name($download_src, 'horizontal_'));
        $height = $image->withFile($dir . $download_src)->getHeight();
        $width = $image->withFile($dir . $download_src)->getWidth();
        return $width > $height ? 'horizontal' : 'vertical';
    }
    
}