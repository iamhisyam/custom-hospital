<?php
namespace App;

class Dependencies {
    private $container;
    
    function __construct($app) {
        $container = $app->getContainer(); // Dependency injection container
        $this->container = $container;
        $this->dependencies(); // Load dependencies into container
        $this->inject($app); // Inject dependencies into controllers
        $this->handlers(); // Set custom handlers
    }
    
    // Setup dependency container
    function dependencies() {
        // Monolog
        $this->container['logger'] = function($c) {
            $logger = new \Monolog\Logger('myLogger');
            $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
            $logger->pushHandler($file_handler);
            return $logger;
        };
        // Eloquent ORM
        $this->container['db'] = function($c) {
            $capsule = new \Illuminate\Database\Capsule\Manager;
            $capsule->addConnection($c['settings']['db']);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        };
        // awurth/SlimValidation
        $this->container['validator'] = function($c) {
            return new \Awurth\SlimValidation\Validator();
        };
    }
    
    // Inject dependencies into controllers
    function inject($app) {
        // User Role
        $this->container['\App\Controllers\UserRoleController'] = function($c) use ($app) {
            return new \App\Controllers\UserRoleController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // User
        $this->container['\App\Controllers\UserController'] = function($c) use ($app) {
            return new \App\Controllers\UserController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Employee
        $this->container['\App\Controllers\EmployeeController'] = function($c) use ($app) {
            return new \App\Controllers\EmployeeController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Company
        $this->container['\App\Controllers\CompanyController'] = function($c) use ($app) {
            return new \App\Controllers\CompanyController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Branch
        $this->container['\App\Controllers\BranchController'] = function($c) use ($app) {
            return new \App\Controllers\BranchController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Department
        $this->container['\App\Controllers\DepartmentController'] = function($c) use ($app) {
            return new \App\Controllers\DepartmentController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Leaves
        $this->container['\App\Controllers\LeaveController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Leaves Trans
         $this->container['\App\Controllers\LeaveTransController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveTransController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Leaves Balance
         $this->container['\App\Controllers\LeaveBalanceController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveBalanceController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };


        // Leave Type
        $this->container['\App\Controllers\LeaveTypeController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveTypeController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Leave Setup
        $this->container['\App\Controllers\LeaveSetupController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveSetupController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Leave Trans Status
        $this->container['\App\Controllers\LeaveTransStatusController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveTransStatusController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Leave Trans Type
        $this->container['\App\Controllers\LeaveTransTypeController'] = function($c) use ($app) {
            return new \App\Controllers\LeaveTransTypeController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Position
        $this->container['\App\Controllers\PositionController'] = function($c) use ($app) {
            return new \App\Controllers\PositionController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Team
         $this->container['\App\Controllers\TeamController'] = function($c) use ($app) {
            return new \App\Controllers\TeamController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Grade
         $this->container['\App\Controllers\GradeController'] = function($c) use ($app) {
            return new \App\Controllers\GradeController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Holiday
         $this->container['\App\Controllers\HolidayController'] = function($c) use ($app) {
            return new \App\Controllers\HolidayController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Medical Checkups
         $this->container['\App\Controllers\MedicalCheckupController'] = function($c) use ($app) {
            return new \App\Controllers\MedicalCheckupController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Labs
        $this->container['\App\Controllers\LabController'] = function($c) use ($app) {
            return new \App\Controllers\LabController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Lab Setup
         $this->container['\App\Controllers\LabSetupController'] = function($c) use ($app) {
            return new \App\Controllers\LabSetupController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

         // Lab Test
         $this->container['\App\Controllers\LabResultController'] = function($c) use ($app) {
            return new \App\Controllers\LabResultController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };

        // Patients
        $this->container['\App\Controllers\PatientController'] = function($c) use ($app) {
            return new \App\Controllers\PatientController($c->get('logger'), $c->get('db'), $c->get('validator'));
        };
    }
    
    // Custom handlers
    function handlers() {
        // 404 custom response
        $this->container['notFoundHandler'] = function($c) {
            return function($request, $response) use ($c) {
                return $c['response']->withJson(['errors' => 'Resource not found'], 404);
            };
        };
    }
}