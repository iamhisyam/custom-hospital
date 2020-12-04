<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\UserRole as UserRole;
use App\Includes\Validations\UserRoleRules as UserRoleRules;

class UserRoleController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "user_roles";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('user_roles');

    
    }
    
    // GET /user_roles
    // Lists all user_roles
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = isset($params['filter'])?$params['filter']:[];
        $sort = isset($params['sort'])?json_decode($params['sort']):[];
        $range = isset($params['range'])?json_decode($params['range']):[];
        
        if(!$sort){$sort[0]="id";$sort[1]="asc";}
        if(!$range){$range[0]="0";$range[1]="0";}

        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo("GET /$this->routeName");
       
        $dataCount = UserRole::count();
        
        $user_role = UserRole::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $user_role], 200);
    }
    
    // GET /user_roles/{id}
    // Retrieve user_role data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $user_role = UserRole::find($args['id']);
        if ($user_role) {
            return $response->withJson([
                //'success' => true,
                'data' => $user_role
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /user_roles
    // Create user_role
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, UserRoleRules::userRolePost());
        $this->logger->addInfo('POST valid /user_roles data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if(!is_null($value))
                    $newData[$key] = $value;
            }

            // Input is valid, so let's do something...
            $user_role =  UserRole::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $user_role );
            
            return $response->withJson([
                'success' => true,
                'id' => $user_role->id
            ], 200);
        } else {
            // Validation error
            $this->logger->addInfo("POST not valid /$this->routeName " );
            return $response->withJson([
                'success' => false,
                'errors' => $validator->getErrors()
            ], 400);
        }
    }
    
    // PUT /user_roles/{id}
    // Updates user_roles
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::positionPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check user_role ID exists
        $user_role = UserRole::find($args['id']);
        if (!$errors && !$user_role) {
            $errors = ['user_roles not found: '.$args['id']];
        }
        // check for duplicate
        // if (!$errors && isset($data['name']) && $user->categories()->where('name', $data['name'])->where('id', '!=', $category->id)->first()) {
        //     $errors = ['Category name already exists'];
        // }
        // No errors? Update DB
        $updatedData = [];
        foreach($data as $key => $value){
            if(!is_null($value))
                $updatedData[$key] = $value;
        }

        if (!$errors && $updatedData) {
            // if (isset($data['name'])) {
            //     $user_role->name = $data['name'];
            //     $user_role->code = $data['code'];
       

            // }
        
            // $user_role->save();
            $updatedUserRole = $this->table->where('id',$args['id'])->update($updatedData);
            return $response->withJson(['success' => true,'id'=>$args['id']], 200);
        } else {
            // Errors found
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
    
    // DELETE /user_roles/{id}
    // Delete a user_role
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $user_role = UserRole::withTrashed()->find($args['id']);
        if (!$errors && !$user_role) {
            $errors = ['UserRole not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $user_role->forceDelete() : $user_role->delete();
            return $response->withJson(['success' => true], 200);
        } else {
            // Errors found
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
}