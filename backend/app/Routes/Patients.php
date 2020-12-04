<?php
namespace App\Routes;

class Patients {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/patients', '\App\Controllers\PatientController:all');
        $app->get('/patients/{id}', '\App\Controllers\PatientController:find');
        $app->post('/patients', '\App\Controllers\PatientController:create');
        $app->put('/patients/{id}', '\App\Controllers\PatientController:update');
        $app->delete('/patients/{id}', '\App\Controllers\PatientController:delete');
        
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