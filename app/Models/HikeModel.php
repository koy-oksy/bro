<?php

namespace App\Models;

use CodeIgniter\Model;

class HikeModel extends Model
{
    protected $table = 'hike';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'hike_type',
        'caption',
        'alias',
        'parsed_url',
        'description',
        'days',
        'dates',
        'format',
        'price',
        'participants',
        'distance',
        'route',
        'active',
        'image_name',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}