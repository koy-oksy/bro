<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

//id бота 
define('TELEGRAM_TOKEN', '6962810540:AAFYZZ0dWuOi5uqqmPGQXBKoEhGQEiXLL-8');

// твій id
define('TELEGRAM_CHATID', '404016080');
//404016080


class Staticpage extends BaseController
{

    protected $helpers = ['config', 'menu_helper'];

    protected $site_name;
    protected $parent_data;
    protected $menu_data;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->site_name = get_config('site-name');
        $this->parent_data = [
            'css' => base_url('css'),
            'js' => base_url('js'),
            'img' => base_url('img'),
            'site' => site_url(),
            'uploads' => base_url("image"),
        ];
        $this->parent_data['slider'] = $this->connectWidget('slider');
        $this->parent_data['counters'] = $this->connectWidget('counters');
        $this->parent_data['about'] = $this->connectWidget('about');
        $this->parent_data['advantage'] = $this->connectWidget('advantage');
        $this->parent_data['love'] = $this->connectWidget('love');
        $this->parent_data['menu_entries'] = get_menu();
    }

    private function connectWidget($widget_name = false)
    {
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
        $builder = $db->table('static-page');
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


        if ($row->tpl_type === 'parser') {
            $layout_data['content'] = $parser->setData($page_data)->render('staticPages/' . $row->alias);
        } else {
            $layout_data['content'] = view('staticPages/' . $row->alias, $page_data);
        }

        return $parser->setData($layout_data)->render('layout');
    }

    public function submit($page)
    {
        if ($page) {
            $this->$page();
        }
        return redirect()->to($this->request->getUserAgent()->getReferrer());
    }


    private function contactFormSubmit()
    {
        $min_length_message = "Ваше {field} занадто короткий. Будь ласка вкажіть довший?";
        $rules = [
            'username' => [
                'label'  => "Ім'я",
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'min_length' => $min_length_message,
                ],
            ],
            'phone' => [
                'label'  => "Телефон",
                'rules'  => 'required|max_length[10]',
                'errors' => [
                    'min_length' => $min_length_message,
                ],
            ],
            'text' => [
                'label'  => "Текст Повідомлення",
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'min_length' => $min_length_message,
                ],
            ],
        ];

        if ($this->validate($rules)) {
            // if we are here, we passed the validation
            $username = $this->request->getVar('username');
            $text = $this->request->getVar('text');
            $phone = $this->request->getVar('phone');
            $message =  ' Нове повідомлення '  . $username  . $text  . $phone;
            $this->message_to_telegram($message);
            session()->setFlashData("frontend_message_controller", "Ваше повідомлення дуже важливе для нас! Ми Вам передзвонимо найближчим часом!");
        } else {
            // if we are here validation was failed and we transfer error messages to UI
            session()->setFlashData("frontend_message_controller", $this->validator->listErrors());
        }
    }

    function message_to_telegram($text)
    {
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => TELEGRAM_CHATID,
                    'text' => $text,
                ),
            )
        );
        curl_exec($ch);
    }
}
