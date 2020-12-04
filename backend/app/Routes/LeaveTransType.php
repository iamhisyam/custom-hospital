<?php
namespace App\Routes;

class LeaveTransType {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leave_trans_type', '\App\Controllers\LeaveTransTypeController:all');
        $app->get('/leave_trans_type/{id}', '\App\Controllers\LeaveTransTypeController:find');
        $app->post('/leave_trans_type', '\App\Controllers\LeaveTransTypeController:create');
        $app->put('/leave_trans_type/{id}', '\App\Controllers\LeaveTransTypeController:update');
        $app->delete('/leave_trans_type/{id}', '\App\Controllers\LeaveTransTypeController:delete');
        
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