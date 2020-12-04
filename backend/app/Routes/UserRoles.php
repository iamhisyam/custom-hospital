<?php
namespace App\Routes;

class UserRoles {
    function __construct($app) {
        
        /* Basic routing */
        $app->get('/user_roles', '\App\Controllers\UserRoleController:all');
        $app->get('/user_roles/{id}', '\App\Controllers\UserRoleController:find');
        $app->post('/user_roles', '\App\Controllers\UserRoleController:create');
        $app->put('/user_roles/{id}', '\App\Controllers\UserRoleController:update');
        $app->delete('/user_roles/{id}', '\App\Controllers\UserRoleController:delete');
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