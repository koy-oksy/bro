<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Hike extends BaseController
{

    protected $helpers = ['config', 'menu'];

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
        $this->parent_data['menu_entries'] = get_menu();
    }
    
    public function index($type, $hike = null): string
    {
        if ($type === 'carpatian') {
            return $this->carpatian($hike);
        } else {
            return $this->foreign($hike);
        }
    }
    
    private function carpatian($hike) {
        $db = \Config\Database::connect();
        $builder = $db->table('hikes');
        
        
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
    
    private function foreign($hike) {
        
        return "";
    }
    
}
