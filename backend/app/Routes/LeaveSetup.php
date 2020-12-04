<?php
namespace App\Routes;

class LeaveSetup {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leave_setup', '\App\Controllers\LeaveSetupController:all');
        $app->get('/leave_setup/{id}', '\App\Controllers\LeaveSetupController:find');
        $app->post('/leave_setup', '\App\Controllers\LeaveSetupController:create');
        $app->put('/leave_setup/{id}', '\App\Controllers\LeaveSetupController:update');
        $app->delete('/leave_setup/{id}', '\App\Controllers\LeaveSetupController:delete');
        
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