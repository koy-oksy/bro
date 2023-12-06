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
    
    
}