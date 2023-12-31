<?php

namespace App\Models;

use CodeIgniter\Model;

class DynamicModel extends Model
{
    protected $table = 'dynamic';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'id',
        'caption',
        'alias',
        'parsed_url',
        'description',
    ];
    
    public function getData() {
        return $this->findAll();
    }
    
    public function deleteDynamic($alias) {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table($this->table);
            $dynamic = $builder->where(['alias' => $alias])->get()->getRow();
            $this->deleteDynamicImages($dynamic->id);
            $db->table($this->table)->where(['alias' => $alias])->delete();
            $db->table('dynamic-chapter')->where(['dynamic_id' => $dynamic->id])->delete();
            $db->table('dynamic-images-to-load')->where(['dynamic_id' => $dynamic->id])->delete();
        } catch (\Throwable $e) {
            var_dump($e->getMessage()); die;
        }
        return true;
    }
    
    public function scanDynamic($parsed_url, $alias = false) {
        // add a new dynamic / rescan
        $dynamicModel = new \App\Models\DynamicModel();
        $dynamic_rec = false;
        if ($alias) {
            $dynamic_rec = $dynamicModel->where(['alias' => $alias])->get()->getRow();
            if (empty($dynamic_rec)) {
                session()->setFlashdata('message_controller', 'Сторінку не знайдено!');
                return "/admin/dynamic/add";
            }
            $parsed_url = $dynamic_rec->parsed_url;
        } else {
            $found_dynamic = $dynamicModel->where('parsed_url', $parsed_url)->get()->getRow();
            if ($found_dynamic) {
                session()->setFlashdata('message_controller', 'Така сторінка вже була додана!');
                return sprintf("/admin/dynamic/%s", $found_dynamic->alias);
            }
        }
        $data['parsed_url'] = $parsed_url;
        if (strpos($data['parsed_url'], 'https://telegra.ph/') === false) {
            session()->setFlashdata('message_controller', 'Вкажіть адресу сторінки яка починається з https://telegra.ph/');
            return "/admin/dynamic/add";
        }
        $parsed_params = parse_bro_url($data['parsed_url'], false);
        if (empty($alias)) {
            $alias = translit_ukr($parsed_params['title']);
        }
        // we check if hike poster not present at hike images, than add it
        if (array_search($parsed_params['image'], $parsed_params['download_src']) === false) {
            array_unshift($parsed_params['download_src'], $parsed_params['image']);
        }
        $new_dynamic = [
            'caption' => $parsed_params['title'],
            'alias' => $alias,
            'parsed_url' => $data['parsed_url'],
            'description' => $parsed_params['description'],
        ];
        if ($dynamic_rec) {
            $dynamic_id = $dynamic_rec->id;
            $dynamicModel->set($new_dynamic);
            $dynamicModel->update($dynamic_id, $new_dynamic);
        } else {
            $dynamicModel->insert($new_dynamic);
            $dynamic_id = $dynamicModel->getInsertID();
        }
        $chapter = new \App\Models\DynamicChapterModel();
        $chapter->where(['dynamic_id' => $dynamic_id])->delete();
        foreach ($parsed_params['chapters'] as $chapter_data) {
            $data = [
                'dynamic_id' => $dynamic_id,
                'text' => implode('', $chapter_data),
            ];
            $chapter->insert($data);
        }
        $this->deleteDynamicImages($dynamic_id);
        $image = new \App\Models\DynamicImageModel();
        $image->where(['dynamic_id' => $dynamic_id])->delete();
        foreach ($parsed_params['download_src'] as $src) {
            $image->insert([
                'dynamic_id' => $dynamic_id,
                'download_src' => $src,
            ]);
        }
        if ($dynamic_rec) {
            session()->setFlashdata('message_controller', 'Сторінку перескановано!');
        } else {
            session()->setFlashdata('message_controller', 'Нову сторінку створено!');
        }
        return "/admin/dynamic/$alias";
    }
    
    public function deleteDynamicImages($dynamic_id) {
        $db = \Config\Database::connect();
        $builder = $db->table('dynamic-images-to-load');
        $images = $builder->where(['dynamic_id' => $dynamic_id])->get()->getResultArray();
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
            $file = WRITEPATH . 'uploads' . modify_image_name($img['download_src'], 'square_');
            if (is_file($file)) {
                unlink($file);
            }
        }
        return true;
    }
}