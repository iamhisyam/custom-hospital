<?php
namespace App\Routes;

class Employees {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/employees', '\App\Controllers\EmployeeController:all');
        $app->get('/employees/{id}', '\App\Controllers\EmployeeController:find');
        $app->post('/employees', '\App\Controllers\EmployeeController:create');
        $app->put('/employees/{id}', '\App\Controllers\EmployeeController:update');
        $app->delete('/employees/{id}', '\App\Controllers\EmployeeController:delete');
        

        
    }
}