<?php

use CodeIgniter\Router\RouteCollection;

/* Frontend routes */
$routes->get('/', 'StaticPage::index/main');
$routes->get('page/(:segment)', 'StaticPage::index/$1');
$routes->post('submit/(:segment)', 'StaticPage::submit/$1');

$routes->get('carpatian-hikes', 'Hike::index/carpatian');
$routes->get('foreign-hikes', 'Hike::index/foreign');
$routes->get('carpatian-hikes/(:segment)', 'Hike::index/carpatian/$1');
$routes->get('foreign-hikes/(:segment)', 'Hike::index/foreign/$1');
/* End Frontend routes */

/* Special routes */
$routes->get('image/processimage/(:segment)', 'Image::processimage/$1');
$routes->get('image/processqueue', 'Image::processqueue');
$routes->get('image/(:segment)/(:segment)', 'Image::index/$1/$2');
$routes->get('vertical/(:segment)/(:segment)', 'Image::vertical/$1/$2');
$routes->get('horizontal/(:segment)/(:segment)', 'Image::horizontal/$1/$2');
/* End Special routes */

/* Admin routes */
$routes->get('admin/hike/(:segment)', 'AdminHike::index/$1');
$routes->get('admin/hike/(:segment)/rescan', 'AdminHike::rescan/$1');
$routes->get('admin/hike/(:segment)/delete', 'AdminHike::delete/$1');
$routes->get('admin/hike/(:segment)/setposter', 'AdminHike::setposter/$1');
$routes->post('admin/hike/(:segment)', 'AdminHike::save/$1');

$routes->get('admin/(:segment)', 'AdminPage::index/$1');
$routes->post('admin/(:segment)', 'AdminPage::index/$1');
$routes->get('admin/(:segment)/(:segment)', 'AdminPage::index/$1/$2');
$routes->post('admin/(:segment)/(:segment)', 'AdminPage::save/$1/$2');


/* End Admin routes */