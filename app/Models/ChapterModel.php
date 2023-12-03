<?php

namespace App\Models;

use CodeIgniter\Model;

class ChapterModel extends Model
{
    protected $table = 'hike-chapter';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'hike_id',
        'text',
    ];
    
    public function getData() {
        return $this->findAll();
    }
    
    public function deleteHike($chapter_id) {
        $db = \Config\Database::connect();
        $db->table('hike-chapter')->where(['id' => $chapter_id])->delete();
        return true;
    }
}