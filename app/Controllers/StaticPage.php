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

        if ($row->tpl_type === 'parser') {
            $layout_data['content'] = $parser->setData($page_data)->render('staticPages/' . $row->tpl_name);
        } else {
            $layout_data['content'] = view('staticPages/' . $row->tpl_name, $page_data);
        }

        return $parser->setData($layout_data)->render('layout');
    }
    
    public function submit($page) {
        if ($page) {
            $this->$page();
        }
        return redirect()->to($this->request->getUserAgent()->getReferrer());
    }
    
    public function contactFormSubmit()
    {
        $rules = [
            'username' => [
                'label'  => "Ім'я",
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'min_length' => "Ваше {field} занадто коротке. Будь ласка вкажіть довше?",
                    'required' => "Ми не приймаємо звернень від анонімусів )",
                ],
            ],
            'phone' => [
                'label'  => "Телефон",
                'rules'  => 'required|max_length[10]',
                'errors' => [
                    'min_length' => "Ваш {field} занадто короткий. Будь ласка вкажіть довший?",
                    'required' => "Ми не приймаємо звернень від анонімусів )",
                ],
            ],
        ];
        
        if ($this->validate($rules)) {
            // if we are here, we passed the validation
            $username = $this->request->getVar('username');
            $text = $this->request->getVar('text');
            $phone = $this->request->getVar('phone');
            
            // !!!! Кіса тут вставляй код для відправки повідомлення в телеграм !!!! Вище 3 змінні з данними юзера
            
            session()->setFlashData("frontend_message_controller", "Ваше повідомлення дуже важливе для нас! Ми вам передзвонимо найближчим часом!");
        } else {
            session()->setFlashData("frontend_message_controller", $this->validator->listErrors());
        }
    }
}
