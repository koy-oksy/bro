<?php

namespace App\Models;

use CodeIgniter\Model;

class StaticpageModel extends Model
{
    protected $table = 'static-page';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'alias',
        'title',
        'description',
        'tpl_type',
    ];
    
    public function getData() {
        return $this->findAll();
    }
}