<?php
namespace App\Routes;

class LabSetup {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/labs_setup', '\App\Controllers\LabSetupController:all');
        $app->get('/labs_setup/{id}', '\App\Controllers\LabSetupController:find');
        $app->post('/labs_setup', '\App\Controllers\LabSetupController:create');
        $app->put('/labs_setup/{id}', '\App\Controllers\LabSetupController:update');
        $app->delete('/labs_setup/{id}', '\App\Controllers\LabSetupController:delete');
        
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