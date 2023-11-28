<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Hike extends BaseController
{

    protected $helpers = ['config', 'menu', 'page'];

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
        $parser = \Config\Services::parser();
        $page_data = $this->parent_data;
        $layout_data = $this->parent_data;
        if ($hike) {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $builder->where('alias', $hike);
            $output = $builder->get();
            $row = $output->getRow();
            $layout_data['title'] = $this->site_name . ' - ' . $row->caption;
            $layout_data['description'] = $row->description;
            $layout_data['tags'] = $row->tags;
            $layout_data['content'] = $parser->setData($page_data)->renderString($row->content);
        } else {
            $path = sprintf("%s..%sapp%sviews%shikes%s%s", FCPATH, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $type);
            $files = array_diff(scandir($path), ['.', '..']);
            $hikes = [];
            foreach ($files as $i => $file) {
                $contents = file_get_contents($path . DIRECTORY_SEPARATOR . $file);
                if (empty($contents)) {
                    continue;
                }
                $meta = get_meta($contents);
                $hikes[] = $meta;
            }
            die;
            $page_data['hikes'] = $hikes;

            $layout_data['title'] = $this->site_name . ' - ' . get_config('carpatians-title');
            $layout_data['description'] = get_config('carpatians-description');
            $layout_data['tags'] = get_config('carpatians-tags');
            $layout_data['content'] = view('carpatian', $page_data);
        }
        return $parser->setData($layout_data)->render('layout');
    }
    
    private function carpatian($hike)
    {
        $parser = \Config\Services::parser();
        $page_data = $this->parent_data;
        $layout_data = $this->parent_data;

        if ($hike) {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $builder->where('alias', $hike);
            $output = $builder->get();
            $row = $output->getRow();
            $layout_data['title'] = $this->site_name . ' - ' . $row->caption;
            $layout_data['description'] = $row->description;
            $layout_data['tags'] = $row->tags;
            $layout_data['content'] = $parser->setData($page_data)->render('hikes/' . $row->tpl_name);
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $output = $builder->get();
            $page_data['hikes'] = $output->getResult();
            $layout_data['title'] = $this->site_name . ' - ' . get_config('carpatians-title');
            $layout_data['description'] = get_config('carpatians-description');
            $layout_data['tags'] = get_config('carpatians-tags');
            $layout_data['content'] = view('carpatian', $page_data);
        }

        return $parser->setData($layout_data)->render('layout');
    }

    private function foreign($hike)
    {
        $parser = \Config\Services::parser();
        $page_data = $this->parent_data;
        $layout_data = $this->parent_data;

        if ($hike) {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $builder->where('alias', $hike);
            $output = $builder->get();
            $row = $output->getRow();
            $layout_data['title'] = $this->site_name . ' - ' . $row->caption;
            $layout_data['description'] = $row->description;
            $layout_data['tags'] = $row->tags;
            $layout_data['content'] = $parser->setData($page_data)->render('hikes/' . $row->tpl_name);
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('hike');
            $output = $builder->get();
            $page_data['hikes'] = $output->getResult();
            $layout_data['title'] = $this->site_name . ' - ' . get_config('foreigns-title');
            $layout_data['description'] = get_config('foreigns-description');
            $layout_data['tags'] = get_config('foreigns-tags');
            $layout_data['content'] = view('foreign', $page_data);
        }

        return $parser->setData($layout_data)->render('layout');
    }
}
