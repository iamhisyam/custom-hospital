<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LeaveTransStatus as LeaveTransStatus;
use App\Includes\Validations\LeaveTransStatusRules as ValidationRules;

class LeaveTransStatusController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "leave_trans_status";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('leave_trans_status');

    
    }
    
    // GET /leave_trans_status
    // Lists all leave_trans_status
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
       
        $dataCount = LeaveTransStatus::count();
        
        $leave_trans_status = LeaveTransStatus::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $leave_trans_status], 200);
    }
    
    // GET /leave_trans_status/{id}
    // Retrieve leave_trans_status data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $leave_trans_status = LeaveTransStatus::find($args['id']);
        if ($leave_trans_status) {
            return $response->withJson([
                //'success' => true,
                'data' => $leave_trans_status
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /leave_trans_status
    // Create leave_trans_status
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::leaveTransStatusPost());
        $this->logger->addInfo('POST valid /leave_trans_statuss data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if(!is_null($value))
                    $newData[$key] = $value;
            }

            // Input is valid, so let's do something...
            $leave_trans_status =  LeaveTransStatus::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $leave_trans_status );
            
            return $response->withJson([
                'success' => true,
                'id' => $leave_trans_status->id
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
    
    // PUT /leave_trans_statuss/{id}
    // Updates leave_trans_statuss
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::leaveTransStatusPost());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check leave_trans_status ID exists
        $leave_trans_status = LeaveTransStatus::find($args['id']);
        if (!$errors && !$leave_trans_status) {
            $errors = ['leave_trans_statuss not found: '.$args['id']];
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
    
    // DELETE /leave_trans_statuss/{id}
    // Delete a leave_trans_status
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $leave_trans_status = LeaveTransStatus::withTrashed()->find($args['id']);
        if (!$errors && !$leave_trans_status) {
            $errors = ['LeaveTransStatus not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $leave_trans_status->forceDelete() : $leave_trans_status->delete();
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