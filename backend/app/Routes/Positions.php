<?php
namespace App\Routes;

class Positions {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/positions', '\App\Controllers\PositionController:all');
        $app->get('/positions/{id}', '\App\Controllers\PositionController:find');
        $app->post('/positions', '\App\Controllers\PositionController:create');
        $app->put('/positions/{id}', '\App\Controllers\PositionController:update');
        $app->delete('/positions/{id}', '\App\Controllers\PositionController:delete');
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