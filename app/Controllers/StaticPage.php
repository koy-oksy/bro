<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Staticpage extends BaseController
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
            'css' => base_url('css'),
            'js' => base_url('js'),
            'img' => base_url('img'),
            'site' => site_url(),
            'uploads' => base_url("image"),
        ];
        $this->parent_data['slider'] = $this->connectWidget('slider');
        $this->parent_data['counters'] = $this->connectWidget('counters');
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
                'url' => '/page/useful',
                'name' => 'Корисне',
            ],
            [
                'active' => '',
                'url' => '/page/contact-form',
                'name' => 'Контакти',
            ],
        ];
    }
    
    private function connectWidget($widget_name = false) {
        if (!$widget_name) {
            return '';
        }
        $widget_model_name = sprintf('App\Models\%sModel', ucfirst($widget_name));
        $widget_model = new $widget_model_name();
        $data = array_merge($this->parent_data, ['widget_entries' => $widget_model->getData()]);
        $parser = \Config\Services::parser();
        $widget_tpl = sprintf("staticPages/widget/%s", strtolower($widget_name));
        return $parser->setData($data)->render($widget_tpl);
    }

    public function index($page): string
    {
        $db = \Config\Database::connect();
        $builder = $db->table('static_page');
        $builder->where('alias', $page);
        $output = $builder->get();
        $row = $output->getRow();

        if (empty($row)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $parser = \Config\Services::parser();

        $page_data = $this->parent_data;
        $layout_data = $this->parent_data;

        $layout_data['title'] = $this->site_name . ' - ' . $row->title;
        $layout_data['description'] = $row->description;
        $layout_data['tags'] = $row->tags;
        $layout_data['menu_entries'] = $this->menu_data;

        $validation = \Config\Services::validation();
        
//        $page_data['validation']
        
        // we check if user did POST request by submitting form
        if ($this->request->is('post')) {
            // we remove non alphanumeric characters from $page variable
            $form_handler = preg_replace( '/[\W]/', '', $page);
            // we call method to handle form submit
            $validation =  $this->$form_handler();
            
//            $page_data['validation'] =
            
        }

        $layout_data['content'] = $parser->setData($page_data)->render('staticPages/' . $row->tpl_name);

        return $parser->setData($layout_data)->render('layout');
    }

    private function contactform()
    {

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric|max_length[10]'
        ];

        if ($this->validate($rules)) {
            $formModel = new FormModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'phone'  => $this->request->getVar('phone'),
            ];
            $formModel->save($data);
            return redirect()->to('/page/contact-form');
        } else {
            return $this->validator;
        }
    }
}
