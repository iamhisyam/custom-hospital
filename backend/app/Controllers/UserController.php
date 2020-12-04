<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Includes\ValidationRules as ValidationRules;
use \App\Models\User as User;

class UserController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('users');
    }
    
    // POST /users
    // Create user
    public function create(Request $request, Response $response) {
        $this->logger->addInfo('POST /users');
        $data = $request->getParsedBody();
        $errors = [];
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::usersPost());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        if (!$errors && User::where(['username' => $data['username']])->first()) {
            $errors[] = 'Username already exists';
        }

        $newData = [];
        foreach($data as $key => $value){
            if($value)
                $newData[$key] = $value;
        }

        if (!$errors) {
            // Input is valid, so let's do something...
            $newUser = User::create($newData);
            return $response->withJson([
                'success' => true,
                'username' => $newUser->username,
                'id' => $newUser->id
            ], 200);
        } else {
            // Error occured
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }


    // PUT /users
    // Update user
    public function update(Request $request, Response $response, $args) {
        $this->logger->addInfo('PUT /users/'.$args['id']);
        $data = $request->getParsedBody();
        $errors = [];
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::usersPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }

        $user =  $this->table->where(['id' => $args['id']])->first();
        if (!$errors && !$user) {
            $errors[] = 'User not found';
        }
        $updatedData = [];
        foreach($data as $key => $value){
            if($value)
                $updatedData[$key] = $value;
        }

        if (!$errors && $updatedData) {
            // Input is valid, so let's do something...
            
            if(isset($updatedData["password"]))
                $updatedData["password"] = password_hash($updatedData["password"], \App\Config\Config::auth()['hash']);
            else
                unset($updatedData["password"]);
            

            $updatedUser = $this->table->where('id',$args['id'])->update($updatedData);
            return $response->withJson([
                'success' => true,
                'id' => $args['id']
            ], 200);
        } else {
            // Error occured
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
    
    // POST /users/login
    public function login(Request $request, Response $response) {
        $this->logger->addInfo('POST /users/login');
        $data = $request->getParsedBody();
        $errors = [];
        $validator = $this->validator->validate($request, ValidationRules::authPost());
        // Validate input
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }


        // validate username
        if (!$errors && !($user = User::where(['username' => $data['username']])->first())) {
            $errors[] = 'Username invalid';
        }
        // validate password
        if (!$errors && !password_verify($data['password'], $user->password)) {
            $errors[] = 'Password invalid';
        }
        if (!$errors) {
            // No errors, generate JWT
            $token = $user->tokenCreate();
            $role = $user->role->code;
            // return token
            return $response->withJson([
                "success" => true,
                "data" => [
                    "token" => $token['token'],
                    "expires" => $token['expires'],
                    "role_code" => $role,
                    "name" => $user->name
                ]
            ], 200);
        } else {
            // Error occured
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }

    // GET /users
    // Lists all users
    public function all(Request $request, Response $response) {
        $this->logger->addInfo('GET /users');

        $params = $request->getQueryParams();

        $filter = $params['filter'];
        $sort = json_decode($params['sort']);
        $range = json_decode($params['range']);

        $take = $range[1]-$range[0]+1;
        
        $userscount  =  User::count();


        $users =  User::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"users ".$range[0]."-".$range[1]."/".$userscount)
            ->withJson(['data' => $users], 200);

    }


    // GET /users/{id}
    // Retrieve user data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo('GET /users/'.$args['id']);
        $user =  User::where('id',$args['id'])->first();
       
        if ($user) {
            return $response->withJson([
                'success' => true,
                'data' => $user 
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'user not found'
            ], 400);
        }
    }
}