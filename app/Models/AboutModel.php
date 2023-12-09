<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table = 'widget-about';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'image_name',
        'text',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}