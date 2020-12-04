<?php
namespace App\Routes;

class Companies {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/companies', '\App\Controllers\CompanyController:all');
        $app->get('/companies/{id}', '\App\Controllers\CompanyController:find');
        $app->post('/companies', '\App\Controllers\CompanyController:create');
        $app->put('/companies/{id}', '\App\Controllers\CompanyController:update');
        $app->delete('/companies/{id}', '\App\Controllers\CompanyController:delete');
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