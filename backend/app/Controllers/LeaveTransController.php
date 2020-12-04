<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LeaveTrans as LeaveTrans;
use \App\Models\LeaveTransStatus as LeaveTransStatus;
use App\Includes\Validations\LeaveTransRules as ValidationRules;

class LeaveTransController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "leaves_trans";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('leaves_trans');

    
    }
    
    // GET /leaves_trans
    // Lists all leaves_transs
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
       
        $dataCount = LeaveTrans::count();
        
        $leaves_trans = LeaveTrans::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $leaves_trans], 200);
    }
    
    // GET /leaves_transs/{id}
    // Retrieve leaves_trans data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $leaves_trans = LeaveTrans::find($args['id']);
        if ($leaves_trans) {
            return $response->withJson([
                //'success' => true,
                'data' => $leaves_trans
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /leaves_transs
    // Create leaves_trans
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::leaveTransPost());
        $this->logger->addInfo('POST valid /leaves_transs data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if($value)
                    $newData[$key] = $value;
            }

            // Input is valid, so let's do something...
            $leaves_trans =  LeaveTrans::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $leaves_trans );
            
            return $response->withJson([
                'success' => true,
                'id' => $leaves_trans->id
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
    
    // PUT /leaves_trans/{id}
    // Updates leaves_trans
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::leaveTransPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check leaves_trans ID exists
        $leaves_trans = LeaveTrans::find($args['id']);
        if (!$errors && !$leaves_trans) {
            $errors = ['leaves_transs not found: '.$args['id']];
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
    
    // DELETE /leaves_transs/{id}
    // Delete a leaves_trans
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $leaves_trans = LeaveTrans::withTrashed()->find($args['id']);
        if (!$errors && !$leaves_trans) {
            $errors = ['LeaveTrans not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $leaves_trans->forceDelete() : $leaves_trans->delete();
            return $response->withJson(['success' => true], 200);
        } else {
            // Errors found
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }


    // PUT /leaves_trans/approval/{id}
    // Updates leaves_trans
    public function approval(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']."/approval");
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::approvalLeaveTransPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check leaves_trans ID exists
        $leaves_trans = LeaveTrans::find($args['id']);
        if (!$errors && !$leaves_trans) {
            $errors = ['leaves_trans not found: '.$args['id']];
        }

        //if(isset($data["leave_status_code"]))
        $leave_trans_status = LeaveTransStatus::where('code',$data["approval_status_code"])->first();
        // check for duplicate
        // if (!$errors && isset($data['name']) && $user->categories()->where('name', $data['name'])->where('id', '!=', $category->id)->first()) {
        //     $errors = ['Category name already exists'];
        // }
        // No errors? Update DB
        $updatedData = [];
        $updatedData['leave_trans_status_id'] = $leave_trans_status->id;
        $updatedData['updated_by'] = $user->id;
        
        if($data['is_approved']){
            $updatedData['approved_by'] = $user->id;
            $updatedData['is_approved'] = $data['is_approved'];
        }else{
            $updatedData['is_approved'] = $data['is_approved'];
        }
        
        // foreach($data as $key => $value){
        //     if($value)
        //         $updatedData[$key] = $value;
        // }

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

    
}