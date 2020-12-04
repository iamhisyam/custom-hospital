<?php
namespace App\Routes;

class Labs {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/labs', '\App\Controllers\LabController:all');
        $app->get('/labs/{id}', '\App\Controllers\LabController:find');
        $app->post('/labs', '\App\Controllers\LabController:create');
        $app->put('/labs/{id}', '\App\Controllers\LabController:update');
        $app->delete('/labs/{id}', '\App\Controllers\LabController:delete');
        
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