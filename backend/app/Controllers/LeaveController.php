<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\Leave as Leave;
use App\Includes\ValidationRules as ValidationRules;

class LeaveController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('leaves');
    }
    
    // GET /leaves
    // Lists all leaves
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = $params['filter'];
        $sort = json_decode($params['sort']);
        $range = json_decode($params['range']);
        
        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo('GET /leaves');
       
        $leavesCount = $user->leaves()->count();
        
        $leaves = $user->leaves()->skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"leaves ".$range[0]."-".$range[1]."/".$leavesCount)
            ->withJson(['data' => $leaves], 200);
    }
    
    // GET /leaves/{id}
    // Retrieve leaves data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo('GET /leaves/'.$args['id']);
        $user = $request->getAttribute('user');
        $leave = $user->leaves()->find($args['id']);
        if ($leave) {
            return $response->withJson([
                //'success' => true,
                'data' => $leave
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'leave not found'
            ], 400);
        }
    }
    
    // GET /categories/{id}/todos
    // Retrieve category's todo items by ID
    public function todos(Request $request, Response $response, $args) {
        $this->logger->addInfo('GET /categories/'.$args['id'].'/todos');
        $user = $request->getAttribute('user');
        $category = $user->categories()->find($args['id']);
        return $response->withJson(['data' => $category->todos()], 200);
    }
    
    // POST /leaves
    // Create leave
    public function create(Request $request, Response $response) {
        $this->logger->addInfo('POST /leaves');
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::leavesPost());
        $this->logger->addInfo('POST valid /leaves data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if($value)
                    $newData[$key] = $value;
            }

            // Input is valid, so let's do something...
            $leave =  $user->leaves()->firstOrCreate($newData);
         
            $this->logger->addInfo('POST valid /leaves '.  $leave );
            
            return $response->withJson([
                'success' => true,
                'id' => $leave->id
            ], 200);
        } else {
            // Validation error
            $this->logger->addInfo('POST not valid /leaves ' );
            return $response->withJson([
                'success' => false,
                'errors' => $validator->getErrors()
            ], 400);
        }
    }
    
    // PUT /categories/{id}
    // Updates leave
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo('PUT /leaves/'.$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::leavesPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check category ID exists
        $leave = $user->leaves()->find($args['id']);
        if (!$errors && !$leave) {
            $errors = ['leaves not found: '.$args['id']];
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
    
    // DELETE /categories/{id}
    // Delete a category
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $leave = $user->leaves()->withTrashed()->find($args['id']);
        if (!$errors && !$leave) {
            $errors = ['Leave not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $leave->forceDelete() : $leave->delete();
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