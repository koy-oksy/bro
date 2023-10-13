<?php

namespace App\Models;

use CodeIgniter\Model;

class CountersModel extends Model
{
    protected $table = 'widget-counters';
    protected $primaryKey = 'id';
    
    public function getData() {
        return $this->findAll();
    }
}