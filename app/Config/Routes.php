<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('landing', 'StaticPage::landing');

/* Frontend routes */
$routes->get('/', 'StaticPage::index/main', ["filter" => "site"]);
$routes->get('page/(:segment)', 'StaticPage::index/$1', ["filter" => "site"]);
$routes->post('submit/(:segment)', 'StaticPage::submit/$1', ["filter" => "site"]);

$routes->get('carpatian-hikes', 'Hike::index/carpatian', ["filter" => "site"]);
$routes->get('foreign-hikes', 'Hike::index/foreign', ["filter" => "site"]);
$routes->get('carpatian-hikes/(:segment)', 'Hike::index/carpatian/$1', ["filter" => "site"]);
$routes->get('foreign-hikes/(:segment)', 'Hike::index/foreign/$1', ["filter" => "site"]);
/* End Frontend routes */

/* Special routes */
$routes->get('image/processimage/(:segment)', 'Image::processimage/$1');
$routes->get('image/processdynamicimage/(:segment)', 'Image::processdynamicimage/$1');
$routes->get('image/processqueue', 'Image::processqueue');
$routes->get('image/(:segment)/(:segment)', 'Image::index/$1/$2');
$routes->get('vertical/(:segment)/(:segment)', 'Image::vertical/$1/$2');
$routes->get('horizontal/(:segment)/(:segment)', 'Image::horizontal/$1/$2');
$routes->get('square/(:segment)/(:segment)', 'Image::square/$1/$2');
/* End Special routes */

/* Admin routes */

$routes->get("admin/login", "AdminLogin::index");
$routes->post("admin/login", "AdminLogin::login");
$routes->get("admin/logout", "AdminLogin::logout");

// Filter on route group
$routes->group("admin", ["filter" => "myauth"] , function($routes){
    $routes->get('hike/(:segment)', 'AdminHike::index/$1');
    $routes->get('hike/(:segment)/rescan', 'AdminHike::rescan/$1');
    $routes->get('hike/(:segment)/delete', 'AdminHike::delete/$1');
    $routes->get('hike/(:segment)/setposter', 'AdminHike::setposter/$1');
    $routes->post('hike/(:segment)', 'AdminHike::save/$1');
    
    $routes->get('dynamic/(:segment)', 'AdminDynamic::index/$1');
    $routes->get('dynamic/(:segment)/rescan', 'AdminDynamic::rescan/$1');
    $routes->get('dynamic/(:segment)/delete', 'AdminDynamic::delete/$1');
    $routes->get('dynamic/(:segment)/setposter', 'AdminDynamic::setposter/$1');
    $routes->post('dynamic', 'AdminDynamic::save');
    $routes->post('dynamic/(:segment)', 'AdminDynamic::save/$1');

    $routes->get('(:segment)', 'AdminPage::index/$1');
    $routes->post('(:segment)', 'AdminPage::save/$1');
    $routes->get('(:segment)/(:segment)', 'AdminPage::index/$1/$2');
    $routes->post('(:segment)/(:segment)', 'AdminPage::save/$1/$2');
});

/* End Admin routes */