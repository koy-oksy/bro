<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'widget-slider';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'image_name',
        'caption',
        'text',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}