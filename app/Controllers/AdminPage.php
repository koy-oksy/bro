<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminpage extends BaseController
{
    
    protected $helpers = ['config'];
    
    protected $site_name;
    protected $parent_data;
    protected $menu_data;
    private $parser;


    const PATH_TO_VIEWS = '../app/Views/staticPages/';
    
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
    
    public function save($page = false, $widget = false)
    {
        $request = \Config\Services::request();
        if ($request->getMethod() !== 'post') {
            return redirect()->to('/admin/home');
        }
        if ($widget) {
            $method = $widget . 'Save';
        } else {
            $method = $page . 'Save';
        }
        return $this->$method();
    }
    
    public function index($page = false, $widget = false): string
    {
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
                
        return $this->parser->setData($layout_data)->render('admin/layout');
    }
    
    private function simplePage($template_name) {
        $request = \Config\Services::request();
        $template_path = sprintf('%s%s.php', self::PATH_TO_VIEWS, $template_name);
        $template_file = new File($template_path);
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
        return $this->parser->setData($page_data)->render(sprintf('admin/%s', $template_name));
    }
        
    // !!! PAGES SECTION !!!
    
    public function home() {
        $layout_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        $page_data = [];
        try {
            $layout_data['content'] = $this->parser->setData($page_data)->render('admin/home');
        } catch (\Throwable $e) {
            $layout_data['content'] = $e->getMessage();
        }
        return $this->parser->setData($layout_data)->render('admin/layout');
    }
    
    private function main() {
        return $this->simplePage('main');
    }
    
    private function useful() {
        return $this->simplePage('useful');
    }
    
    private function contacts() {
        $page_data = [];
        return $this->parser->setData($page_data)->render('admin/contacts');
    }
    
    private function settings() {
        $page_data = [];
        return $this->parser->setData($page_data)->render('admin/settings');
    }
    
    // !!! END PAGES SECTION !!!
    
    // !!! WIDGETS SECTION !!!
    
    private function sliderSave() {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $caption = $request->getVar('caption');
        $text = $request->getVar('text');
        $sliderModel = new \App\Models\SliderModel();
        $data = [
            'caption' => $caption,
            'text' => $text,
        ];
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $img = $request->getFile('image');
            if (! $img->hasMoved()) {
                $data['image_name'] = $img->store();
            }
        }
        $sliderModel->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/slider');
    }
    
    private function slider() {
        $widget_model = new \App\Models\SliderModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'slider',
        ]);
        return view('admin/widget/slider', $page_data);
    }
    
    private function countersSave() {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $max_number = $request->getVar('max_number');
        $text = $request->getVar('text');
        $countersModel = new \App\Models\CountersModel();
        $data = [
            'max_number' => $max_number,
            'text' => $text,
        ];
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $img = $request->getFile('image');
            if (! $img->hasMoved()) {
                $data['image_name'] = $img->store();
            }
        }
        $countersModel->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/counters');
    }
    
    private function counters() {
        $widget_model = new \App\Models\CountersModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'counters',
        ]);
        return view('admin/widget/counters', $page_data);
    }
    
    // !!! END WIDGETS SECTION !!!
}
