<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Adminpage extends BaseController
{
    
    protected $helpers = ['config'];
    
    protected $site_name;
    protected $parent_data;
    protected $menu_data;
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->site_name = get_config('site_name');
        $this->parent_data = [
            'css' => base_url('admin/css'),
            'js' => base_url('admin/js'),
            'img' => base_url('admin/img'),
            'admin' => site_url('admin'),
            'vendors' => base_url('admin/vendors'),
        ];
        $this->menu_data = [
            [
                'active' => 'active',
                'url' => '/',
                'name' => 'Головна',
            ],
            [
                'active' => '',
                'url' => '/page/carpatian-hikes',
                'name' => 'Походи в Карпати',
            ],
            [
                'active' => '',
                'url' => '/page/foreign-hikes',
                'name' => 'Мандрівки закордон',
            ],
            [
                'active' => '',
                'url' => '/page/about',
                'name' => 'Про нас',
            ],
            [
                'active' => '',
                'url' => '/page/useful',
                'name' => 'Корисне',
            ],
            [
                'active' => '',
                'url' => '/page/contact',
                'name' => 'Контакти',
            ],
        ];
    }
    
    public function index($page = false): string
    {
        $parser = \Config\Services::parser();
        
        $layout_data = $this->parent_data;
        
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        try {
            $layout_data['content'] = $this->$page();
        } catch (\Throwable $e) {
            $layout_data['content'] = $this->error($e);
        }
        
        return $parser->setData($layout_data)->render('admin/layout');
    }
    
    private function error($e) {
        return $e->getMessage();
    }
    
    private function main() {
        $parser = \Config\Services::parser();
        $page_data = [];
        return $parser->setData($page_data)->render('admin/main');
    }
    
    private function about() {
        $parser = \Config\Services::parser();
        $page_data = [];
        return $parser->setData($page_data)->render('admin/about');
    }
    
    private function useful() {
        $parser = \Config\Services::parser();
        $page_data = [];
        return $parser->setData($page_data)->render('admin/useful');
    }
    
    private function contacts() {
        $parser = \Config\Services::parser();
        $page_data = [];
        return $parser->setData($page_data)->render('admin/contacts');
    }
    
    private function settings() {
        $parser = \Config\Services::parser();
        $page_data = [];
        return $parser->setData($page_data)->render('admin/settings');
    }
    
}
