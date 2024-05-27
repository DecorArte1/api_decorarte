<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "Users::index", ['filter' => 'authFilter']);
    $routes->post('Users/create', 'Users::create');
    $routes->get('users/show/(:num)', 'Users::show/$1');
    $routes->get("users", "Users::index");
    
    $routes->put('api/users/(:num)', 'Users::update/$1');


    $routes->delete('api/users/(:num)', 'Users::delete/$1');

   
});

