<?php
namespace App\Routes;

class LeavesTrans {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leaves_trans', '\App\Controllers\LeaveTransController:all');
        $app->get('/leaves_trans/{id}', '\App\Controllers\LeaveTransController:find');
        $app->post('/leaves_trans', '\App\Controllers\LeaveTransController:create');
        $app->put('/leaves_trans/{id}', '\App\Controllers\LeaveTransController:update');
        $app->delete('/leaves_trans/{id}', '\App\Controllers\LeaveTransController:delete');
        $app->put('/leaves_trans/approval/{id}', '\App\Controllers\LeaveTransController:approval');
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