<?php

namespace App\Models;

use CodeIgniter\Model;

class AdvantageModel extends Model
{
    protected $table = 'widget-advantage';
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