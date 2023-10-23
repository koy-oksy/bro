<?php

namespace App\Models;

use CodeIgniter\Model;

class CountersModel extends Model
{
    protected $table = 'widget-counters';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'image_name',
        'max_number',
        'text',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}