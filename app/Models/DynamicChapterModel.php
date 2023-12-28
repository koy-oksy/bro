<?php

namespace App\Models;

use CodeIgniter\Model;

class DynamicChapterModel extends Model
{
    protected $table = 'dynamic-chapter';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'dynamic_id',
        'text',
    ];
    
    public function getData() {
        return $this->findAll();
    }
    
    public function deleteChapter($chapter_id) {
        $db = \Config\Database::connect();
        $db->table($this->table)->where(['id' => $chapter_id])->delete();
        return true;
    }
}