<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\Department as Department;
use App\Includes\ValidationRules as ValidationRules;

class DepartmentController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "departments";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('departments');
    }
    
    // GET /departments
    // Lists all departments
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
       
        $dataCount = Department::count();
        
        $department = Department::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $department], 200);
    }
    
    // GET /departments/{id}
    // Retrieve department data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $department = Department::find($args['id']);
        if ($department) {
            return $response->withJson([
                //'success' => true,
                'data' => $department
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /departments
    // Create department
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::departmentPost());
        $this->logger->addInfo('POST valid /departments data '.  json_encode($data) );
        if ($validator->isValid()) {

     

            $newData = [];
            foreach($data as $key => $value){
                if($value)
                    $newData[$key] = $value;
            }


            // Input is valid, so let's do something...
            $department =  Department::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $department );
            
            return $response->withJson([
                'success' => true,
                'id' => $department->id
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
    
    // PUT /departments/{id}
    // Updates departments
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::departmentPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check department ID exists
        $department = Department::find($args['id']);
        if (!$errors && !$department) {
            $errors = ['departments not found: '.$args['id']];
        }
        // check for duplicate
        // if (!$errors && isset($data['name']) && $user->categories()->where('name', $data['name'])->where('id', '!=', $category->id)->first()) {
        //     $errors = ['Category name already exists'];
        // }
        // No errors? Update DB
        $updatedData = [];
        foreach($data as $key => $value){
            if($value)
                $updatedData[$key] = $value;
        }

        // No errors? Update DB
        if (!$errors && $updatedData) {
            $rs = $this->table->where('id',$args['id'])->update($updatedData);
        
            return $response->withJson(['success' => true,'id'=>$args['id']], 200);
        } else {
            // Errors found
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
    
    // DELETE /departments/{id}
    // Delete a department
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $department = Department::withTrashed()->find($args['id']);
        if (!$errors && !$department) {
            $errors = ['Department not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $department->forceDelete() : $department->delete();
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