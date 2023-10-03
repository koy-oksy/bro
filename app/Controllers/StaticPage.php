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
        $layout_data['content'] = $parser->setData($page_data)->render('staticPages/' . $row->tpl_name);

        return $parser->setData($layout_data)->render('layout');
    }
}
