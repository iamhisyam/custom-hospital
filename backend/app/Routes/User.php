<?php
namespace App\Routes;

class User {
    function __construct($app) {

        $app->post('/users', '\App\Controllers\UserController:create');
        $app->get('/users', '\App\Controllers\UserController:all');
        $app->get('/users/{id}', '\App\Controllers\UserController:find');
        $app->post('/users/login', '\App\Controllers\UserController:login');
        $app->put('/users/{id}', '\App\Controllers\UserController:update');

    }
}