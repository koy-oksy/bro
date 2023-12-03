<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminhike extends BaseController
{
    
    protected $helpers = ['config', 'parser'];
    
    protected $site_name;
    protected $parent_data;
    protected $menu_data;
    private $parser;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        helper(['filesystem', 'form']);
        
        $this->parser = \Config\Services::parser();
        $this->site_name = get_config('site_name');
        $this->parent_data = [
            'css' => base_url('admin/css'),
            'js' => base_url('admin/js'),
            'img' => base_url('admin/img'),
            'fimg' => base_url('img'),
            'uploads' => base_url('image'),
            'admin' => site_url('admin'),
            'vendors' => base_url('admin/vendors'),
            'message' => '',
        ];
        
        if(session()->has('message_controller')) {
            $this->parent_data['message'] =  session()->getFlashdata('message_controller');
        }
        
    }
    
    public function save($type = 'carpatian')
    {
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $redirect = "/admin/hike/$type";
        if ($hike) {
            $id = $request->getPost('id');
            $data = [
                'active' => $request->getPost('active') === 'on' ? 1 : 0,
                'caption' => $request->getPost('caption'),
                'alias' => $request->getPost('alias'),
                'description' => $request->getPost('description'),
                'tags' => $request->getPost('tags'),
                'price' => $request->getPost('price'),
            ];
            if (isset($_FILES['image_name']) && $_FILES['image_name']['size'] > 0) {
                $img = $request->getFile('image_name');
                if (! $img->hasMoved()) {
                    $data['image_name'] = $img->store();
                }
            }
            $hikeModel = new \App\Models\HikeModel();
            $hikeModel->update($id, $data);
            
            $redirect .= "?hike=$hike";
            session()->setFlashdata('message_controller', 'Зміни збережені!');
            return redirect()->redirect($redirect);
        } else {
            // add a new hike
            $data['parsed_url'] = $request->getPost('parsed_url');

            if (strpos($data['parsed_url'], 'https://telegra.ph/') === false) {
                session()->setFlashdata('message_controller', 'Вкажіть адресу сторінки яка починається з https://telegra.ph/');
                return redirect()->redirect($redirect);
            }            
            $parsed_params = parse_bro_url($request->getPost('parsed_url'));
            
//            var_dump($parsed_params); die;

            $parsed_params['image']; // image_name
            $parsed_params['chapters']; // texts
            $parsed_params['download_src']; // all images from article
            
            $alias = translit_ukr($parsed_params['title']);
            
            $new_hike = [
                'hike_type' => $type,
                'caption' => $parsed_params['title'],
                'alias' => $alias,
                'parsed_url' => $data['parsed_url'],
                'description' => $parsed_params['description'],
                'days' => $parsed_params['days'],
                'dates' => $parsed_params['date'] ? $parsed_params['date'] : $parsed_params['dates'],
                'format' => $parsed_params['format'],
                'price' => $parsed_params['price'],
                'participants' => $parsed_params['participants'],
                'distance' => $parsed_params['distance'],
                'route' => $parsed_params['route'],
                'active' => 0,
                'image_name' => '',
            ];
            $hikeModel = new \App\Models\HikeModel();
            $hikeModel->insert($new_hike);
            
            $hike_id = $hikeModel->getInsertID();
            foreach ($parsed_params['chapters'] as $chapter_data) {
                $chapter = new \App\Models\ChapterModel();
                $data = [
                    'hike_id' => $hike_id,
                    'text' => implode('', $chapter_data),
                ];
                $chapter->insert($data);
            }
            
            $redirect .= "?hike=$alias";
            session()->setFlashdata('message_controller', 'Новий похід створено!');
            return redirect()->redirect($redirect);
        }
    }
    
    public function index($type = 'carpatian')
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        
        $page_data = $this->parent_data;
        if ($hike) {
            $delete = $request->getGet('delete');
            if ($delete) {
                $hikeModel = new \App\Models\HikeModel();
                $hikeModel->deleteHike($type, $hike);
                $redirect = "/admin/hike/$type";
                return redirect()->redirect($redirect);
            }
            $builder = $db->table('hike');
            $output = $builder->where(['hike_type' => $type, 'alias' => $hike])->get();
            $page_data['hike'] = $output->getRow();
            $layout_data['content'] = view('admin/hike', $page_data);
        } else {
            $builder = $db->table('hike');
            $output = $builder->where(['hike_type' => $type])->orderBy('id', 'desc')->get();
            $page_data['hikes'] = $output->getResult();
            $layout_data['content'] = view('admin/hikes', $page_data);
        }
        
        return $this->parser->setData($layout_data)->render('admin/layout');
    }
    
}
