<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'alias',
        'type',
        'user_data',
        'date',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}