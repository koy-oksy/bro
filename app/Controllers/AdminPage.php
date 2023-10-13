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
    
    const PATH_TO_VIEWS = '../app/Views/staticPages/';
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        helper(['filesystem', 'form']);
        
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
        $template_name = 'main';
        $template_path = sprintf('%s%s.php', self::PATH_TO_VIEWS, $template_name);
        $template_file = new \CodeIgniter\Files\File($template_path);
        if ($template_file->isWritable()) {
            $content = file_get_contents($template_file->getRealPath());
            $page_data = [
                'form_open' => form_open('admin/' . $template_name),
                'form_close' => form_close(),
                'template_name' => $template_name,
                'template_content' => $content,
            ];
        } else {
            $page_data = [
                'template_content' => sprintf('Template File "%s" is not writebale', $template_path),
            ];
        }
        return $parser->setData($page_data)->render('admin/main');
    }
    
    public function widget($widget_name) {
        $parser = \Config\Services::parser();
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        try {
            $layout_data['content'] = $this->$widget_name();
        } catch (\Throwable $e) {
            $layout_data['content'] = $this->error($e);
        }
        return $parser->setData($layout_data)->render('admin/layout');
    }
    
    private function slider() {
        $parser = \Config\Services::parser();
        $template_name = 'slider';
        $content = '123';
        $page_data = [
            'form_open' => form_open('admin/' . $template_name),
            'form_close' => form_close(),
            'template_name' => $template_name,
            'template_content' => $content,
        ];
        
        return $parser->setData($page_data)->render('admin/widget/' . $template_name);
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
