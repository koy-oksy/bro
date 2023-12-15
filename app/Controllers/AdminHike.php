<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminhike extends BaseController
{
    
    protected $helpers = ['config', 'parser', 'filesystem', 'form', 'menu'];
    
    protected $site_name;
    protected $parent_data;
    protected $menu_data;
    private $parser;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->parser = \Config\Services::parser();
        $this->site_name = get_config('site-name');
        $this->parent_data = [
            'site_url' => site_url(),
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
    
    public function save($hike_type = 'carpatian')
    {
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $hikeModel = new \App\Models\HikeModel();
        if ($hike) {
            $id = $request->getPost('id');
            $data = [
                'active' => $request->getPost('active') === 'on' ? 1 : 0,
                'caption' => $request->getPost('caption'),
                'alias' => $request->getPost('alias'),
                'description' => $request->getPost('description'),
                'days' => $request->getPost('days'),
                'dates' => $request->getPost('dates'),
                'format' => $request->getPost('format'),
                'participants' => $request->getPost('participants'),
                'distance' => $request->getPost('distance'),
                'route' => $request->getPost('route'),
                'difficulty' => $request->getPost('difficulty'),
                'price' => $request->getPost('price'),
            ];
            $hikeModel->update($id, $data);
            $redirect = "/admin/hike/$hike_type?hike=$hike";
            session()->setFlashdata('message_controller', 'Зміни збережені!');
            return redirect()->redirect($redirect);
        } else {
            $parsed_url = $request->getGetPost('parsed_url');
            $redirect = $hikeModel->scanHike($parsed_url, $hike_type);
            return redirect()->redirect($redirect);
        }
    }
    
    public function rescan($hike_type = 'carpatian') {
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $parsed_url = $request->getGetPost('parsed_url');
        $hikeModel = new \App\Models\HikeModel();
        $redirect = $hikeModel->scanHike($parsed_url, $hike_type, $hike);
        return redirect()->redirect($redirect);
    }
    
    public function delete($hike_type = 'carpatian') {
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $hikeModel = new \App\Models\HikeModel();
        $hikeModel->deleteHike($hike_type, $hike);
        $redirect = "/admin/hike/$hike_type";
        return redirect()->redirect($redirect);
    }
    
    public function setposter($hike_type = 'carpatian') {
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $set_poster = $request->getGet('set_poster');
        $redirect = "/admin/hike/$hike_type?hike=$hike";
        $imageModel = new \App\Models\ImageModel();
        $image = $imageModel->find($set_poster);
        if (empty($image)) {
            session()->setFlashdata('message_controller', 'Помилка: зображення не знайдено, оновіть сторінку');
            return redirect()->redirect($redirect);    
        }
        $image_name = $image['download_src'];
        $hikeModel = new \App\Models\HikeModel();
        $hikeModel->where('alias', $hike)
            ->set(['image_name' => $image_name])
            ->update();
        session()->setFlashdata('message_controller', 'Обкладинку походу змінено');
        return redirect()->redirect($redirect);
    }
    
    public function index($hike_type = 'carpatian')
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $page_data = $this->parent_data;
        if ($hike) {
            $builder = $db->table('hike');
            $output = $builder->where(['hike_type' => $hike_type, 'alias' => $hike])->get();
            $page_data['hike'] = $output->getRow();
            $builder = $db->table('images-to-load');
            $output = $builder->where(['hike_id' => $page_data['hike']->id])->get();
            $page_data['download_src'] = $output->getResultArray();
            $layout_data['content'] = view('admin/hike', $page_data);
        } else {
            $builder = $db->table('hike');
            $output = $builder->where(['hike_type' => $hike_type])->orderBy('id', 'desc')->get();
            $page_data['hikes'] = $output->getResult();
            $page_data['hike_type'] = $hike_type;
            $layout_data['content'] = view('admin/hikes', $page_data);
        }
        return view('admin/layout', $layout_data);
    }
    
}
