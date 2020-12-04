<?php
namespace App\Routes;

class MedicalCheckups {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/medical_checkups', '\App\Controllers\MedicalCheckupController:all');
        $app->get('/medical_checkups/{id}', '\App\Controllers\MedicalCheckupController:find');
        $app->post('/medical_checkups', '\App\Controllers\MedicalCheckupController:create');
        $app->put('/medical_checkups/{id}', '\App\Controllers\MedicalCheckupController:update');
        $app->delete('/medical_checkups/{id}', '\App\Controllers\MedicalCheckupController:delete');
        
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