<?php
namespace App;

class Middleware {
    private $app;
    private $container;
    
    function __construct($app) {
        $this->app = $app;
        $container = $app->getContainer(); // Dependency injection container
        $this->container = $container;
        $this->cors();
        $this->jwt();
    }
    
    // CORS
    function cors() {

        $this->app->add(function($request, $response, $next) {
            $route = $request->getAttribute("route");
        
            $methods = [];
        
            if (!empty($route)) {
                $pattern = $route->getPattern();
        
                foreach ($this->router->getRoutes() as $route) {
                    if ($pattern === $route->getPattern()) {
                        $methods = array_merge_recursive($methods, $route->getMethods());
                    }
                }
                //Methods holds all of the HTTP Verbs that a particular route handles.
            } else {
                $methods[] = $request->getMethod();
            }
        
            $response = $next($request, $response);
        
        
            return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader("Access-Control-Expose-Headers",'Content-Range')
                
                // ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')             
              
                //>withHeader("Access-Control-Allow-Methods", implode(",", $methods));

                ->withHeader('Access-Control-Allow-Headers', $request->getHeaderLine('Access-Control-Request-Headers'))        
                ->withHeader("Access-Control-Allow-Methods", $request->getHeaderLine('Access-Control-Request-Method'));
                
        });
        
        // $this->app->add(function ($req, $res, $next) {
        //     $response = $next($req, $res);
        //     return $response
        //             ->withHeader('Access-Control-Allow-Origin', '*')
        //             ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        //             ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        // });
    }
    
    // JWT Authentication (tuupola/slim-jwt-auth)
    function jwt() {
        $this->container->get('db'); // JWT middleware callbacks dependent on DB, make sure Eloquent is initalized
        $this->app->add(new \Tuupola\Middleware\JwtAuthentication([
            "attribute" => "jwt",
            "path" => ["/"],
            "ignore" => ["/users/login","users"],
            "secret" => \App\Config\Config::auth()['secret'],
            "secure" => \App\Config\Config::auth()['secure'],
            "logger" => $this->container['logger'],
            "error" => function ($response, $arguments) {
                return $response->withJson([
                    'success' => false,
                    'errors' => $arguments["message"]
                ], 401);
            },
            "before" => function ($request, $arguments) {
                $user = \App\Models\User::find($arguments['decoded']['sub']);
                return $request->withAttribute("user", $user);
            }
        ]));
    }
}