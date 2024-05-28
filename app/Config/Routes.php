<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    // Rutas de autenticación
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
   
    
    // Rutas de usuarios
    $routes->group("users", function ($routes) {
        $routes->get("/", "Users::index", ['filter' => 'authFilter']);
        $routes->post("create", "Users::create");
        $routes->get("login/(:num)", "Users::login/$1");
        $routes->get("show/(:num)", "Users::show/$1");
        $routes->put("update/(:num)", "Users::update/$1");
        $routes->delete("delete/(:num)", "Users::delete/$1");
    });

    // Rutas de clientes
    $routes->group("clients", function ($routes) {
        $routes->get("/", "Clients::index", ['filter' => 'authFilter']);
        $routes->post("create", "Clients::create");
        $routes->get("show/(:num)", "Clients::show/$1");
        $routes->put("update/(:num)", "Clients::update/$1");
        $routes->delete("delete/(:num)", "Clients::delete/$1");
    });
    

    // Rutas de diseñadores
    $routes->group("designers", function ($routes) {
        $routes->get("/", "Designers::index", ['filter' => 'authFilter']);
        $routes->post("create", "Designers::create");
        $routes->get("show/(:num)", "Designers::show/$1");
        $routes->put("update/(:num)", "Designers::update/$1");
        $routes->delete("delete/(:num)", "Designers::delete/$1");
    });
});
