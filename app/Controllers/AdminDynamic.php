<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Admindynamic extends BaseController
{
    
    protected $helpers = ['config', 'parser', 'filesystem', 'form', 'menu', 'page'];
    
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
    
    public function save($alias = '')
    {
        $request = \Config\Services::request();
        $dynamicModel = new \App\Models\DynamicModel();
        if ($alias) {
            $id = $request->getPost('id');
            $data = [
                'caption' => $request->getPost('caption'),
                'alias' => $request->getPost('alias'),
                'description' => $request->getPost('description'),
            ];
            $dynamicModel->update($id, $data);
            $redirect = "/admin/dynamic/$alias";
            session()->setFlashdata('message_controller', 'Зміни збережені!');
            return redirect()->redirect($redirect);
        } else {
            $parsed_url = $request->getGetPost('parsed_url');
            $redirect = $dynamicModel->scanDynamic($parsed_url);
            return redirect()->redirect($redirect);
        }
    }
    
    public function rescan($alias) {
        $request = \Config\Services::request();
        $parsed_url = $request->getGetPost('parsed_url');
        $dynamicModel = new \App\Models\DynamicModel();
        $redirect = $dynamicModel->scanDynamic($parsed_url, $alias);
        return redirect()->redirect($redirect);
    }
    
    public function delete($alias) {
        $request = \Config\Services::request();
        $dynamicModel = new \App\Models\DynamicModel();
        $dynamicModel->deleteHike($alias);
        $redirect = "/admin/";
        return redirect()->redirect($redirect);
    }
        
    public function index($alias)
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $page_data = $this->parent_data;
        $builder = $db->table('dynamic');
        $output = $builder->where(['alias' => $alias])->get();
        $page_data['dynamic'] = $output->getRow();
        $builder = $db->table('dynamic-images-to-load');
        $output = $builder->where(['dynamic_id' => $page_data['dynamic']->id])->get();
        $page_data['download_src'] = $output->getResultArray();
        $layout_data['content'] = view('admin/dynamic', $page_data);
        return view('admin/layout', $layout_data);
    }
    
}
