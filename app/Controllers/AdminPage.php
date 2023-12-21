<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminpage extends BaseController
{
    
    protected $helpers = ['config', 'menu', 'filesystem', 'form', 'page'];
    
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
            $id = $request->getVar('id');
            $data = $request->getVar();
            
            $model_name = "\\App\\Models\\" . ucfirst($widget) . "Model";
            $widget_model = new $model_name();
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $img = $request->getFile('image');
                if (! $img->hasMoved()) {
                    $data['image_name'] = $img->store();
                }
            }
            
            $widget_model->update($id, $data);
            session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
            return redirect()->to('/admin/main#' . 'page-' . $widget . '-tab');
        } else {
            $template_code = $request->getVar('template_code');
            $template_path = sprintf('%s%s.php', self::PATH_TO_VIEWS, $page);
            $template_file = new File($template_path);
            file_put_contents($template_file->getRealPath(), $template_code);
            session()->setFlashData("message_controller", "<i class='fa fa-save'></i> Зміни збережені!");
        }
        return redirect()->to('/admin/' . $page);
    }
    
    public function index($page = false): string
    {
        if ($page === 'home') {
            return $this->showHome();
        }
        if ($page === 'help') {
            return $this->showHelp();
        }
        $layout_data = $this->parent_data;
        $page_data = $this->parent_data;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        try {
            $model = new \App\Models\StaticpageModel();
            $db_content = $model->where(['alias' => $page])->first();
            $page_data['page'] = $db_content;
            $relative_path = sprintf('%s%s.php', self::PATH_TO_VIEWS, $db_content['alias']);
            if (!is_file($relative_path)) {
                $f = fopen($relative_path, "w");
                fwrite($f, '<!-- Нова сторінка -->');
            }
            $template_path = $relative_path;
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
    
    private function showHome() {
        $layout_data = $this->parent_data;
        $page_data = $this->parent_data;
        $hikeModel = new \App\Models\HikeModel();
        $page_data['carpatian_count'] = $hikeModel->where('hike_type', 'carpatian')->countAllResults();
        $page_data['foreign_count'] = $hikeModel->where('hike_type', 'foreign')->countAllResults();
        $page_data['not_active_count'] = $hikeModel->where('active', '0')->countAllResults();
        $logModel = new \App\Models\LogModel();
        $page_data['all_count'] = $logModel->countAllResults();
        $logs = $logModel->orderBy('created_at', 'desc')->findAll(3);
        $page_data['logs'] = $logs;
        $layout_data['title'] = $this->site_name . ' - Admin';
        $layout_data['menu_entries'] = $this->menu_data;
        $layout_data['content'] = view('admin/home', $page_data);
        return view('admin/layout', $layout_data);
    }
    
    private function showHelp() {
        $layout_data = $this->parent_data;
        $page_data = $this->parent_data;
        $layout_data['content'] = view('admin/help', $page_data);
        $layout_data['title'] = $this->site_name . ' - Admin';
        return view('admin/layout', $layout_data);
    }
}
