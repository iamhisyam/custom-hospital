<?php
namespace App\Routes;

class LeaveTransStatus {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leave_trans_status', '\App\Controllers\LeaveTransStatusController:all');
        $app->get('/leave_trans_status/{id}', '\App\Controllers\LeaveTransStatusController:find');
        $app->post('/leave_trans_status', '\App\Controllers\LeaveTransStatusController:create');
        $app->put('/leave_trans_status/{id}', '\App\Controllers\LeaveTransStatusController:update');
        $app->delete('/leave_trans_status/{id}', '\App\Controllers\LeaveTransStatusController:delete');
        
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