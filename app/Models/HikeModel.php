<?php

namespace App\Models;

use CodeIgniter\Model;

class HikeModel extends Model
{
    protected $table = 'hike';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'alias',
        'caption',
        'description',
        'tags',
        'price',
        'hike_type',
        'image_name',
        'active',
        'content',
        'parsed_url',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}