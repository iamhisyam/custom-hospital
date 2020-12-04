<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LeaveTransType as LeaveTransType;
use App\Includes\Validations\LeaveTransTypeRules as ValidationRules;

class LeaveTransTypeController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('leave_trans_type');
    }
    
    // GET /leave type
    // Lists all leave type
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = isset($params['filter'])?$params['filter']:[];
        $sort = isset($params['sort'])?json_decode($params['sort']):[];
        $range = isset($params['range'])?json_decode($params['range']):[];
        
        if(!$sort){$sort[0]="id";$sort[1]="asc";}
        if(!$range){$range[0]="0";$range[1]="0";}

        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo('GET /leave_trans_type');
       
        $leaveTransTypeCount = LeaveTransType::count();
        
        $leaveTransType = LeaveTransType::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"leave_trans_type ".$range[0]."-".$range[1]."/".$leaveTransTypeCount)
            ->withJson(['data' => $leaveTransType], 200);
    }
    
    // GET /leaves/{id}
    // Retrieve leaves data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo('GET /leave_trans_type/'.$args['id']);
        $user = $request->getAttribute('user');
        $leaveTransType = LeaveTransType::find($args['id']);
        if ($leaveTransType) {
            return $response->withJson([
                //'success' => true,
                'data' => $leaveTransType
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
        $this->logger->addInfo('POST /leave_trans_type');
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::leaveTransTypePost());
        $this->logger->addInfo('POST valid /leave type data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if(!is_null($value))
                    $newData[$key] = $value;
            }

            // Input is valid, so let's do something...
            $leaveTransType =  LeaveTransType::firstOrCreate($newData);
         
            $this->logger->addInfo('POST valid /leaves '.  $leaveTransType );
            
            return $response->withJson([
                'success' => true,
                'id' => $leaveTransType->id
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
    
    // PUT /leave_trans_type/{id}
    // Updates leave
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo('PUT /leave_trans_type/'.$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::leaveTransTypePut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check category ID exists
        $leaveTransType = LeaveTransType::find($args['id']);
        if (!$errors && !$leaveTransType) {
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
    
    // DELETE /leave_trans_type/{id}
    // Delete a leave_trans_type
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $leaveTransType = LeaveTransType::withTrashed()->find($args['id']);
        if (!$errors && !$leaveTransType) {
            $errors = ['Leave not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $leaveTransType->forceDelete() : $leaveTransType->delete();
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