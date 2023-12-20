<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'title',
        'url',
        'created_at',
        'user_data',
        'type',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}