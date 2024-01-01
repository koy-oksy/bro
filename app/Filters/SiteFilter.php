<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SiteFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper(['config']);
        $active = get_config('site-active');
        
        if (!$active) {
            return redirect()->to(site_url('landing'));
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        return $response;
    }
}