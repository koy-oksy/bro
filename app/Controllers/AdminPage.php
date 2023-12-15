<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminpage extends BaseController
{
    
    protected $helpers = ['config', 'menu', 'filesystem', 'form'];
    
    protected $site_name;
    protected $parent_data;
    protected $menu_data;
    private $parser;

    const PATH_TO_VIEWS = '../app/Views/staticPages/';
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->parser = \Config\Services::parser();
        $this->site_name = get_config('site-name');
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
    
    public function index($page = false): string
    {
        $layout_data = $this->parent_data;
        $page_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        try {
            $model = new \App\Models\StaticpageModel();
            $db_content = $model->where(['alias' => $page])->first();
            $page_data['page'] = $db_content;
            
            $template_path = sprintf('%s%s.php', self::PATH_TO_VIEWS, $db_content['alias']);
            $template_file = new File($template_path);
            $structure = file_get_contents($template_file->getRealPath());
            $page_data['structure'] = $structure;
            
            $db = \Config\Database::connect();
            $builder = $db->table('page-widget');
            $page_widget = $builder->where(['page_alias' => $page])->get();
            $widgets = [];
            foreach ($page_widget->getResultArray() as $w) {
                $widget_class = "\\App\\Models\\" . ucfirst($w['widget_name']) . "Model";
                $widget_model = new $widget_class();
                $w_data = array_merge($this->parent_data, [
                    'name' => $w['widget_name'],
                    'caption' => $w['widget_caption'],
                    'entries' => $widget_model->getData(),
                ]);
                $w_data['content'] = view('admin/widget/' . $w['widget_name'], $w_data);
                $widgets[] = $w_data;
            }
            $page_data['widgets'] = $widgets;
            $layout_data['content'] = view('admin/static-page', $page_data);
        } catch (\Throwable $e) {
            $layout_data['content'] = $e->getMessage();
        }
                
        return view('admin/layout', $layout_data);
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
        return $this->simplePage('home');
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
        $widget_model = new \App\Models\SliderModel();
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
        $widget_model->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/main/slider');
    }
    
    private function slider() {
        $widget_model = new \App\Models\SliderModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'slider',
        ]);
        return view('admin/widget/slider', $page_data);
    }
    
    private function aboutSave() {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $text = $request->getVar('text');
        $widget_model = new \App\Models\AboutModel();
        $data = [
            'text' => $text,
        ];
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $img = $request->getFile('image');
            if (! $img->hasMoved()) {
                $data['image_name'] = $img->store();
            }
        }
        $widget_model->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/main/about');
    }
    
    private function about() {
        $widget_model = new \App\Models\AboutModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'about',
        ]);
        return view('admin/widget/about', $page_data);
    }
    
    private function advantageSave() {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $text = $request->getVar('text');
        $widget_model = new \App\Models\AdvantageModel();
        $data = [
            'text' => $text,
        ];
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $img = $request->getFile('image');
            if (! $img->hasMoved()) {
                $data['image_name'] = $img->store();
            }
        }
        $widget_model->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/main/advantage');
    }
    
    private function advantage() {
        $widget_model = new \App\Models\AdvantageModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'advantage',
        ]);
        return view('admin/widget/advantage', $page_data);
    }
    
    private function countersSave() {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $max_number = $request->getVar('max_number');
        $text = $request->getVar('text');
        $widget_model = new \App\Models\CountersModel();
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
        $widget_model->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/main/counters');
    }
    
    private function counters() {
        $widget_model = new \App\Models\CountersModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'counters',
        ]);
        return view('admin/widget/counters', $page_data);
    }
    
    private function loveSave() {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $text = $request->getVar('text');
        $widget_model = new \App\Models\LoveModel();
        $data = [
            'text' => $text,
        ];
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $img = $request->getFile('image');
            if (! $img->hasMoved()) {
                $data['image_name'] = $img->store();
            }
        }
        $widget_model->update($id, $data);
        session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        return redirect()->to('/admin/main/love');
    }
    
    private function love() {
        $widget_model = new \App\Models\LoveModel();
        $page_data = array_merge($this->parent_data, [
            'widget_entries' => $widget_model->getData(),
            'widget_name' => 'love',
        ]);
        return view('admin/widget/love', $page_data);
    }
    
    // !!! END WIDGETS SECTION !!!
}
