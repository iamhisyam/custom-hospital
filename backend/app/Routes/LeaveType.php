<?php
namespace App\Routes;

class LeaveType {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leave_type', '\App\Controllers\LeaveTypeController:all');
        $app->get('/leave_type/{id}', '\App\Controllers\LeaveTypeController:find');
        $app->post('/leave_type', '\App\Controllers\LeaveTypeController:create');
        $app->put('/leave_type/{id}', '\App\Controllers\LeaveTypeController:update');
        $app->delete('/leave_type/{id}', '\App\Controllers\LeaveTypeController:delete');
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