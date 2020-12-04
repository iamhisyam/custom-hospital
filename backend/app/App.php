<?php
namespace App;

class App {
    private $app;
    
    public function __construct() {
        // initalize Slim App
        $app = new \Slim\App(\App\Config\Config::slim());
        $this->app = $app;
        // initalize dependencies
        $this->dependencies();
        // initalize middlewares
        $this->middleware();
        // initalize routes
        $this->routes();
    }
    
    public function get() {
        return $this->app;
    }
    
    private function dependencies() {
        return new \App\Dependencies($this->app);
    }
    
    private function middleware() {
        return new \App\Middleware($this->app);
    }
    
    private function routes() {
        return [
            new \App\Routes\UserRoles($this->app),  
            new \App\Routes\User($this->app),       
            new \App\Routes\Companies($this->app),
            new \App\Routes\Branches($this->app),
            new \App\Routes\Departments($this->app),
            new \App\Routes\Employees($this->app),
            new \App\Routes\LeaveType($this->app),
            new \App\Routes\LeaveSetup($this->app),
            new \App\Routes\LeaveTransStatus($this->app),
            new \App\Routes\LeaveTransType($this->app),
            new \App\Routes\Positions($this->app),
            new \App\Routes\Grades($this->app),
            new \App\Routes\Teams($this->app),
            new \App\Routes\Leaves($this->app),
            new \App\Routes\LeavesTrans($this->app),
            new \App\Routes\LeavesBalance($this->app),
            new \App\Routes\Holidays($this->app),
            new \App\Routes\MedicalCheckups($this->app),
            new \App\Routes\Labs($this->app),
            new \App\Routes\LabSetup($this->app),
            new \App\Routes\LabResult($this->app),
            new \App\Routes\Patients($this->app),
           
        ];
    }
}