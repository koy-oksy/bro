<?php

namespace App\Models;

use CodeIgniter\Model;

class LoveModel extends Model
{
    protected $table = 'widget-love';
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