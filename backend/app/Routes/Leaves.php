<?php
namespace App\Routes;

class Leaves {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leaves', '\App\Controllers\LeaveController:all');
        $app->get('/leaves/{id}', '\App\Controllers\LeaveController:find');
        $app->post('/leaves', '\App\Controllers\LeaveController:create');
        $app->put('/leaves/{id}', '\App\Controllers\LeaveController:update');
        $app->delete('/leaves/{id}', '\App\Controllers\LeaveController:delete');
       // $app->get('/leaves/{id}/todos', '\App\Controllers\CategoryController:todos');
        
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