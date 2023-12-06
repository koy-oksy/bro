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
        try {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $hike = $builder->where(['hike_type' => $type, 'alias' => $alias])->get()->getRow();
            
            $builder = $db->table('images-to-load');
            $images = $builder->where(['hike_id' => $hike->id])->get()->getResultArray();
            foreach ($images as $img) {
                $file = WRITEPATH . 'uploads' . $img['download_src'];
                if (is_file($file)) {
                    unlink($file);
                }
                
                $file = WRITEPATH . 'uploads' . modify_image_name($img['download_src'], 'vertical_');
                if (is_file($file)) {
                    unlink($file);
                }
                
                $file = WRITEPATH . 'uploads' . modify_image_name($img['download_src'], 'horizontal_');
                if (is_file($file)) {
                    unlink($file);
                }
                
            }
            
            $db->table('hike')->where(['hike_type' => $type, 'alias' => $alias])->delete();
            $db->table('hike-chapter')->where(['hike_id' => $hike->id])->delete();
            $db->table('images-to-load')->where(['hike_id' => $hike->id])->delete();
            
        } catch (\Throwable $e) {
            var_dump($e->getMessage()); die;
        }
        return true;
    }
}