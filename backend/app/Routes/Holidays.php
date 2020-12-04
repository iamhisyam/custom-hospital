<?php
namespace App\Routes;

class Holidays {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/holidays', '\App\Controllers\HolidayController:all');
        $app->get('/holidays/{id}', '\App\Controllers\HolidayController:find');
        $app->post('/holidays', '\App\Controllers\HolidayController:create');
        $app->put('/holidays/{id}', '\App\Controllers\HolidayController:update');
        $app->delete('/holidays/{id}', '\App\Controllers\HolidayController:delete');
        
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