<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LeaveType as LeaveType;
use App\Includes\Validations\LeaveTypeRules as ValidationRules;

class LeaveTypeController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('leave_type');
    }
    
    // GET /leave type
    // Lists all leave type
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = isset($params['filter'])?$params['filter']:[];
        $sort = isset($params['sort'])?json_decode($params['sort']):['id','asc'];
        $range = isset($params['range'])?json_decode($params['range']):[0,10];
        
        //if(!$sort){$sort[0]="id";$sort[1]="asc";}
        //if(!$range){$range[0]="0";$range[1]="0";}

        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo('GET /leave_type');
       
        $leaveTypeCount = LeaveType::count();
        
        $leaveType = LeaveType::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"leave_type ".$range[0]."-".$range[1]."/".$leaveTypeCount)
            ->withJson(['data' => $leaveType], 200);
    }
    
    // GET /leaves/{id}
    // Retrieve leaves data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo('GET /leave_type/'.$args['id']);
        $user = $request->getAttribute('user');
        $leaveType = LeaveType::find($args['id']);
        if ($leaveType) {
            return $response->withJson([
                //'success' => true,
                'data' => $leaveType
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'leave type not found'
            ], 400);
        }
    }
    

    
    // POST /leaves
    // Create leave type
    public function create(Request $request, Response $response) {
        $this->logger->addInfo('POST /leave_type');
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::leaveTypePost());
        $this->logger->addInfo('POST valid /leave type data '.  json_encode($data) );
        if ($validator->isValid()) {

     
            $newData = [];
            foreach($data as $key => $value){
                if(!is_null($value))
                    $newData[$key] = $value;
            }
            // Input is valid, so let's do something...
            $leaveType =  LeaveType::firstOrCreate($newData);
         
            $this->logger->addInfo('POST valid /leaves '.  $leaveType );
            
            return $response->withJson([
                'success' => true,
                'id' => $leaveType->id
            ], 200);
        } else {
            // Validation error
            $this->logger->addInfo('POST not valid /leave type ' );
            return $response->withJson([
                'success' => false,
                'errors' => $validator->getErrors()
            ], 400);
        }
    }
    
    // PUT /leave_type/{id}
    // Updates leave
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo('PUT /leave_type/'.$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::leaveTypePut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check category ID exists
        $leaveType = LeaveType::find($args['id']);
        if (!$errors && !$leaveType) {
            $errors = ['leave type not found: '.$args['id']];
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
    
    // DELETE /leave_type/{id}
    // Delete a leave_type
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $leaveType = LeaveType::withTrashed()->find($args['id']);
        if (!$errors && !$leaveType) {
            $errors = ['Leave not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $leaveType->forceDelete() : $leaveType->delete();
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