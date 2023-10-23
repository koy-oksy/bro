<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'StaticPage::index/main');
$routes->get('page/(:segment)', 'StaticPage::index/$1');
$routes->get('admin/home', 'AdminPage::home');
$routes->get('admin/(:segment)', 'AdminPage::index/$1');
$routes->post('admin/(:segment)', 'AdminPage::index/$1');

$routes->get('admin/(:segment)/(:segment)', 'AdminPage::index/$1/$2');
$routes->post('admin/(:segment)/(:segment)', 'AdminPage::index/$1/$2');

$routes->get('admin/image/(:segment)', 'AdminPage::index/$1/$2');