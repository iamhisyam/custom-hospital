<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\Employee as Employee;
use App\Includes\ValidationRules as ValidationRules;

class EmployeeController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "employees";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('employees');

    
    }
    
    // GET /employees
    // Lists all employees
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = isset($params['filter'])?$params['filter']:[];
        $sort = isset($params['sort'])?json_decode($params['sort']):["id","asc"];
        $range = isset($params['range'])?json_decode($params['range']):[0,10];
        
        //if(!$sort){$sort[0]="id";$sort[1]="asc";}
        //if(!$range){$range[0]="0";$range[1]="0";}

        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo("GET /$this->routeName");
       
        $dataCount = Employee::count();
        
        //$employee = Employee::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();

        $employee = Employee::skip($range[0])->take($take);
        //print_r($filter);
        if(is_array($filter) || is_object($filter)){

            foreach($filter as $param_key => $param_value) {
                //echo $param_key;
                if (is_array($param_value))
                    $employee->whereIn($param_key,$param_value);
                else
                    $employee->where($param_key,$param_value);
            }
        }
        $employee = $employee->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $employee,'range'=>$range], 200);
    }
    
    // GET /employees/{id}
    // Retrieve employees data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $employee = Employee::find($args['id']);
        if ($employee) {
            return $response->withJson([
                //'success' => true,
                'data' => $employee
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /employees
    // Create employee
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::employeePost());
        $this->logger->addInfo('POST valid /branchs data '.  json_encode($data) );

        //check for duplicate
        if (!$errors && isset($data['code']) && Employee::where('code', $data['code'])->first()) {
            $errors = ['Employee code already exists'];
        }
        if ($validator->isValid() && !$errors) {

            $newData = [];
            foreach($data as $key => $value){
                if(!is_null($value))
                    $newData[$key] = $value;
            }


            // Input is valid, so let's do something...
            $employee =  Employee::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $employee );
            
            return $response->withJson([
                'success' => true,
                'id' => $employee->id
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
    
    // PUT /employees/{code}
    // Updates employees
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::employeePut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check employee ID exists
        $employee = Employee::find($args['id']);
        if (!$errors && !$employee) {
            $errors = ['employee not found: '.$args['id']];
        }
        //check for duplicate
        // if (!$errors && isset($data['id']) && Employee::where('id', $data['id'])->first()) {
        //     $errors = ['Employee code already exists'];
        // }
        // No errors? Update DB
        $updatedData = [];
        foreach($data as $key => $value){
            if(!is_null($value))
                $updatedData[$key] = $value;
        }
        if (!$errors && $updatedData) {
            $rs = $this->table->where('id',$args['id'])->update($updatedData);
            
            return $response->withJson(['success' => true], 200);
        } else {
            // Errors found
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
    
    // DELETE /employees/{id}
    // Delete a employees
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $employee = Employee::withTrashed()->find($args['id']);
        if (!$errors && !$employee) {
            $errors = ['Employee not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $employee->forceDelete() : $employee->delete();
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