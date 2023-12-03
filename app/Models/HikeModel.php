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
    
    public function deleteHike($type, $alias) {
        $db = \Config\Database::connect();
        $builder = $db->table('hike');
        $keys = ['hike_type' => $type, 'alias' => $alias];
        $hike = $builder->where($keys)->get()->getRow();
        $builder->where($keys)->delete();
        $db->table('hike-chapter')->where(['hike_id' => $hike->id])->delete();
        return true;
    }
}