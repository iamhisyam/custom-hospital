<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LeaveBalance as LeaveBalance;
use \App\Models\LeaveSetup as LeaveSetup;
use \App\Models\Employee as Employee;
use App\Includes\Validations\LeaveBalanceRules as ValidationRules;

class LeaveBalanceController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "leaves_balance";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('leaves_balance');

    
    }
    
    // GET /leaves_balance
    // Lists all leaves_balances
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
       
        $dataCount = LeaveBalance::count();
        
        $leaves_balance = LeaveBalance::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $leaves_balance], 200);
    }
    
    // GET /leaves_balances/{id}
    // Retrieve leaves_balance data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $leaves_balance = LeaveBalance::find($args['id']);
        if ($leaves_balance) {
            return $response->withJson([
                //'success' => true,
                'data' => $leaves_balance
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /leaves_balances
    // Create leaves_balance
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::leaveBalancePost());
        $this->logger->addInfo('POST valid /leaves_balances data '.  json_encode($data) );
        if ($validator->isValid()) {

            $isBulk = $data['bulk_input'];
            $leaveSetupId = $data['leave_setup_id'];
            $employeeId = $data["employee_id"];

            $newData = [];
         

            //select all employees that still active
            $employees = Employee::where('status','1');

            //check if  employee selected
            if(!$isBulk && $employeeId ) $employees->where('id',$employeeId);
            $employees = $employees->get();
            
            foreach($employees as $id => $employee){

                $leaveSetup = LeaveSetup::where('id',$leaveSetupId)->where('grade_id',$employee->grade_id)->first();

                $newBalance = [];

                // check the setup found or exist
                if($leaveSetup){
                    $newBalance['employee_id'] = $employee->id;
                    $newBalance['leave_setup_id'] = $leaveSetup->id;
                    $newBalance['leave_setup_code'] = $leaveSetup->code;
                    $newBalance['year'] = $leaveSetup->year;
                    $newBalance['month'] = $leaveSetup->days_per_month;
                    $newBalance['days'] = $leaveSetup->days;
                    $newBalance['valid_at'] = date('Y-m-d');
                    $newBalance['expired_at'] = date('Y-m-d', strtotime("+".$leaveSetup->expire_count." days"));
                    array_push($newData,$newBalance);
                }
                
            }
            // if exists insert
            if($newData)
                $leaves_balance =  LeaveBalance::insert($newData);
            //}
            
            // foreach($data as $key => $value){
            //     if($value)
            //         $newData[$key] = $value;
            // }

            // Input is valid, so let's do something...
            //$leaves_balance =  LeaveBalance::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $leaves_balance );
            
            return $response->withJson([
                'success' => true,
                'id' => $leaves_balance,
               'grade' => $grade
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
    
    // PUT /leaves_balance/{id}
    // Updates leaves_balance
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::leaveBalancePut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check leaves_balance ID exists
        $leaves_balance = LeaveBalance::find($args['id']);
        if (!$errors && !$leaves_balance) {
            $errors = ['leaves_balances not found: '.$args['id']];
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
    
    // DELETE /leaves_balances/{id}
    // Delete a leaves_balance
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $leaves_balance = LeaveBalance::withTrashed()->find($args['id']);
        if (!$errors && !$leaves_balance) {
            $errors = ['LeaveBalance not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $leaves_balance->forceDelete() : $leaves_balance->delete();
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