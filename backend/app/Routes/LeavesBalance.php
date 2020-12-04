<?php
namespace App\Routes;

class LeavesBalance {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/leaves_balance', '\App\Controllers\LeaveBalanceController:all');
        $app->get('/leaves_balance/{id}', '\App\Controllers\LeaveBalanceController:find');
        $app->post('/leaves_balance', '\App\Controllers\LeaveBalanceController:create');
        $app->put('/leaves_balance/{id}', '\App\Controllers\LeaveBalanceController:update');
        $app->delete('/leaves_balance/{id}', '\App\Controllers\LeaveBalanceController:delete');
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