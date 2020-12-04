<?php
namespace App\Routes;

class Grades {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/grades', '\App\Controllers\GradeController:all');
        $app->get('/grades/{id}', '\App\Controllers\GradeController:find');
        $app->post('/grades', '\App\Controllers\GradeController:create');
        $app->put('/grades/{id}', '\App\Controllers\GradeController:update');
        $app->delete('/grades/{id}', '\App\Controllers\GradeController:delete');
        
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