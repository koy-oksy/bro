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
            'message' => '',
        ];
        
        if(session()->has('message_controller')) {
            $this->parent_data['message'] =  session()->getFlashdata('message_controller');
        }
            
    }
    
    public function index($page = false, $widget = false): string
    {
        $parser = \Config\Services::parser();
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        
        try {
            if ($widget) {
                $layout_data['content'] = $this->$widget();
            } else {
                $layout_data['content'] = $this->$page();
            }
        } catch (\Throwable $e) {
            $layout_data['content'] = $e->getMessage();
        }
                
        return $parser->setData($layout_data)->render('admin/layout');
    }
    
    public function home() {
        $parser = \Config\Services::parser();
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        $page_data = [];
        try {
            $layout_data['content'] = $parser->setData($page_data)->render('admin/home');
        } catch (\Throwable $e) {
            $layout_data['content'] = $e->getMessage();
        }
                
        return $parser->setData($layout_data)->render('admin/layout');
    }


    private function simplePage($template_name) {
        $parser = \Config\Services::parser();
        $request = \Config\Services::request();
        $template_path = sprintf('%s%s.php', self::PATH_TO_VIEWS, $template_name);
        $template_file = new \CodeIgniter\Files\File($template_path);
        if ($template_file->isWritable()) {
            if ($request->getMethod() === 'post') {
                $template_code = $request->getVar('template_code');
                file_put_contents($template_file->getRealPath(), $template_code);
                session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
            }
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
        return $parser->setData($page_data)->render(sprintf('admin/%s', $template_name));
    }
    
    private function main() {
        return $this->simplePage('main');
    }
    
    private function useful() {
        return $this->simplePage('useful');
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
