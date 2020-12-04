<?php
namespace App\Routes;

class Teams {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/teams', '\App\Controllers\TeamController:all');
        $app->get('/teams/{id}', '\App\Controllers\TeamController:find');
        $app->post('/teams', '\App\Controllers\TeamController:create');
        $app->put('/teams/{id}', '\App\Controllers\TeamController:update');
        $app->delete('/teams/{id}', '\App\Controllers\TeamController:delete');
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