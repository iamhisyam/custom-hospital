<?php
namespace App\Routes;

class Departments {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/departments', '\App\Controllers\DepartmentController:all');
        $app->get('/departments/{id}', '\App\Controllers\DepartmentController:find');
        $app->post('/departments', '\App\Controllers\DepartmentController:create');
        $app->put('/departments/{id}', '\App\Controllers\DepartmentController:update');
        $app->delete('/departments/{id}', '\App\Controllers\DepartmentController:delete');
        
        /*
         * Route grouping example:
         * 
        $app->group('/categories', function () {
            $this->get('', '\App\Controllers\CategoryController:all');
            $this->post('', '\App\Controllers\CategoryController:create');
            $this->get('/{id}', '\App\Controllers\CategoryController:find');
            $this->put('/{id}', '\App\Controllers\CategoryController:update');
            $this->delete('/{id}', '\App\Controllers\CategoryController:delete');
            $this->get('/{id}/todos', '\App\Controllers\CategoryController:todos');
        });
         */
        
    }
}