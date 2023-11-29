<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminhike extends BaseController
{
    
    protected $helpers = ['config'];
    
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
            $redirect .= "?hike=$hike";
        } else {
            
        }
        session()->setFlashdata('message_controller', 'Зміни збережені!');
        return redirect()->redirect($redirect);
    }
    
    public function index($type = 'carpatian')
    {
        $request = \Config\Services::request();
        $hike = $request->getGet('hike');
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        
        $page_data = $this->parent_data;
        if ($hike) {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $output = $builder->where(['hike_type' => $type, 'alias' => $hike])->get();
            $page_data['hike'] = $output->getRow();
            $layout_data['content'] = view('admin/hike', $page_data);
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $output = $builder->where(['hike_type' => $type])->get();
            $page_data['hikes'] = $output->getResult();
            $layout_data['content'] = view('admin/hikes', $page_data);
        }
        
        return $this->parser->setData($layout_data)->render('admin/layout');
    }
    
}
