<?php
namespace App\Routes;

class Branches {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/branches', '\App\Controllers\BranchController:all');
        $app->get('/branches/{id}', '\App\Controllers\BranchController:find');
        $app->post('/branches', '\App\Controllers\BranchController:create');
        $app->put('/branches/{id}', '\App\Controllers\BranchController:update');
        $app->delete('/branches/{id}', '\App\Controllers\BranchController:delete');
        
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