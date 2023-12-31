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
        'total_price',
        'participants',
        'distance',
        'route',
        'difficulty',
        'active',
        'image_name',
    ];
    
    public function getData() {
        return $this->findAll();
    }
    
    public function deleteHike($type, $alias) {
        try {
            $db = \Config\Database::connect();
            $builder = $db->table($this->table);
            $hike = $builder->where(['hike_type' => $type, 'alias' => $alias])->get()->getRow();
            $this->deleteHikeImages($hike->id);
            $db->table('hike')->where(['hike_type' => $type, 'alias' => $alias])->delete();
            $db->table('hike-chapter')->where(['hike_id' => $hike->id])->delete();
            $db->table('images-to-load')->where(['hike_id' => $hike->id])->delete();
        } catch (\Throwable $e) {
            var_dump($e->getMessage()); die;
        }
        return true;
    }
    
    public function scanHike($parsed_url, $hike_type, $hike = false) {
        // add a new hike / rescan
        $hikeModel = new \App\Models\HikeModel();
        if ($hike) {
            $hike_rec = $hikeModel->where(['alias' => $hike])->get()->getRow();
            if (empty($hike_rec)) {
                session()->setFlashdata('message_controller', 'Похід не знайдено!');
                return "/admin/hike/$hike_type?hike=$hike";
            }
            $parsed_url = $hike_rec->parsed_url;
        } else {
            $found_hike = $hikeModel->where('parsed_url', $parsed_url)->get()->getRow();
            if ($found_hike) {
                session()->setFlashdata('message_controller', 'Такіий похід вже було додано!');
                return sprintf("/admin/hike/%s?hike=%s", $hike_type, $found_hike->alias);
            }
        }
        $data['parsed_url'] = $parsed_url;
        if (strpos($data['parsed_url'], 'https://telegra.ph/') === false) {
            session()->setFlashdata('message_controller', 'Вкажіть адресу сторінки яка починається з https://telegra.ph/');
            return "/admin/hike/$hike_type";
        }
        $parsed_params = parse_bro_url($data['parsed_url']);
        $alias = translit_ukr($parsed_params['title']);
        // we check if hike poster not present at hike images, than add it
        if (array_search($parsed_params['image'], $parsed_params['download_src']) === false) {
            array_unshift($parsed_params['download_src'], $parsed_params['image']);
        }
        $new_hike = [
            'hike_type' => $hike_type,
            'caption' => $parsed_params['title'],
            'alias' => $alias,
            'parsed_url' => $data['parsed_url'],
            'description' => $parsed_params['description'],
            'days' => $parsed_params['days'],
            'dates' => $parsed_params['date'] ? $parsed_params['date'] : $parsed_params['dates'],
            'format' => $parsed_params['format'],
            'price' => $parsed_params['price'],
            'total_price' => $parsed_params['total_price'],
            'participants' => $parsed_params['participants'],
            'distance' => $parsed_params['distance'],
            'route' => $parsed_params['route'],
            'image_name' => $parsed_params['image'],
            'difficulty' => $parsed_params['difficulty'],
            'active' => 0,
        ];
        if ($hike) {
            $hike_id = $hike_rec->id;
            $hikeModel->set($new_hike);
            $hikeModel->update($hike_id, $new_hike);
        } else {
            $hikeModel->insert($new_hike);
            $hike_id = $hikeModel->getInsertID();
        }
        $chapter = new \App\Models\ChapterModel();
        $chapter->where(['hike_id' => $hike_id])->delete();
        foreach ($parsed_params['chapters'] as $chapter_data) {
            $data = [
                'hike_id' => $hike_id,
                'text' => implode('', $chapter_data),
            ];
            $chapter->insert($data);
        }
        $this->deleteHikeImages($hike_id);
        $image = new \App\Models\ImageModel();
        $image->where(['hike_id' => $hike_id])->delete();
        foreach ($parsed_params['download_src'] as $src) {
            $image->insert([
                'hike_id' => $hike_id,
                'download_src' => $src,
            ]);
        }
        if ($hike) {
            session()->setFlashdata('message_controller', 'Похід перескановано!');
            return "/admin/hike/$hike_type?hike=$alias";
        } else {
            session()->setFlashdata('message_controller', 'Новий похід створено!');
            return "/admin/hike/$hike_type?hike=$alias";
        }
    }
    
    public function deleteHikeImages($hike_id) {
        $db = \Config\Database::connect();
        $builder = $db->table('images-to-load');
        $images = $builder->where(['hike_id' => $hike_id])->get()->getResultArray();
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