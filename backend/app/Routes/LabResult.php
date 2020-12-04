<?php
namespace App\Routes;

class LabResult{
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/labs_result', '\App\Controllers\LabResultController:all');
        $app->get('/labs_result/{id}', '\App\Controllers\LabResultController:find');
        $app->post('/labs_result', '\App\Controllers\LabResultController:create');
        $app->put('/labs_result/{id}', '\App\Controllers\LabResultController:update');
        $app->delete('/labs_result/{id}', '\App\Controllers\LabResultController:delete');
        
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