<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'widget-slider';
    protected $primaryKey = 'id';
    
    public function getData() {
        return $this->findAll();
    }
}