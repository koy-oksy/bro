<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'images-to-load';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'hike_id',
        'download_src',
        'loaded',
    ];
    
    public function getData() {
        return $this->findAll();
    }
    
    public function downloadImage($download_src) {
        if (strpos($download_src, 'http') === false) {
            $file_contents = file_get_contents("https://telegra.ph" . $download_src);
        } else {
            $file_contents = file_get_contents($download_src);
            $download_src = get_alt_image_name($download_src);
        }
        
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
        $image->withFile($dir . $download_src) 
            ->fit(1518, 1518, 'center') 
            ->save($dir . modify_image_name($download_src, 'square_'));
        
        $height = $image->withFile($dir . $download_src)->getHeight();
        $width = $image->withFile($dir . $download_src)->getWidth();
        
        if ($width > $height * 1.2) {
            return 'horizontal';
        } elseif ($height > $width * 1.2) {
            return 'vertical';
        } else {
            return 'square';
        }
    }
    
}