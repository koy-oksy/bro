<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Hike extends BaseController
{

    protected $helpers = ['config', 'menu', 'page', 'parser'];

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

    public function index($hike_type, $hike = null): string
    {
        $db = \Config\Database::connect();
        $parser = \Config\Services::parser();
        $page_data = $this->parent_data;
        $layout_data = $this->parent_data;
        if ($hike) {
            $builder = $db->table('hike');
            $builder->where('alias', $hike);
            $row = $builder->get()->getRowArray();
            
            if (empty($row)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            $builder = $db->table('hike-chapter');
            $row['chapters'] = $builder->where(['hike_id' => $row['id']])->get()->getResultArray();
            
            $page_data = array_merge($page_data, $row);
            $layout_data['title'] = $this->site_name . ' - ' . $row['caption'];
            $layout_data['description'] = $row['description'];
            $layout_data['content'] = view('hike', $page_data);
        } else {
            $builder = $db->table('hike');
            $keys = [
                'hike_type' => $hike_type,
                'active' => 1,
            ];
            $page_data['hikes'] = $builder->where($keys)->get()->getResultArray();
            
            $layout_data['title'] = $this->site_name . ' - ' . get_config('carpatians-title');
            $layout_data['description'] = get_config('carpatians-description');
            $layout_data['content'] = view($hike_type, $page_data);
        }
        return $parser->setData($layout_data)->render('layout');
    }
    
}
