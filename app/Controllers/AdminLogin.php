<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;

class Adminlogin extends BaseController
{

    protected $helpers = ['config', 'form'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->site_name = get_config('site-name');
    }

    public function index(): string
    {
        $data = [
            'site_name' => $this->site_name,
            'message' => session()->getFlashdata('message_controller'),
        ];
        return view('admin/login', $data);
    }

    public function login()
    {
        $request = \Config\Services::request();
        $login = $request->getPost('login');
        $password = $request->getPost('password');
        // 
        if ($login === 'brotour' && $this->hash($password) === '5c93a1a0206d04eddbdaa54c89097a52') {
            session()->set('isLoggedIn', '1');
            return redirect()->redirect('/admin/home');
        } else {
            session()->setFlashdata('message_controller', 'Не правильний логін та(або) пароль!');
            return redirect()->redirect('/admin/login');
        }
    }

    public function logout()
    {
        session()->set('isLoggedIn', '0');
        return redirect()->redirect('/admin/login');
    }

    private function hash($password)
    {
        $salt = 'f1ff736266845f654ea95bc212903068';
        return md5($salt . $password);
    }
}
