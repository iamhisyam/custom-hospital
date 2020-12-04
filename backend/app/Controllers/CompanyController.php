<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LeaveType as LeaveType;
use \App\Models\Company as Company;
use App\Includes\ValidationRules as ValidationRules;

class CompanyController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('companies');
    }
    
    // GET /companies
    // Lists all companies
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = isset($params['filter'])?$params['filter']:[];
        $filter = json_decode($filter);
        $sort = isset($params['sort'])?json_decode($params['sort']):[];
        $range = isset($params['range'])?json_decode($params['range']):[];
        
        if(!$sort){$sort[0]="id";$sort[1]="asc";}
        if(!$range){$range[0]="0";$range[1]="0";}

        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo('GET /companies');
       
        $companyCount = Company::count();
        
        $company = Company::skip($range[0])->take($take);
        //print_r($filter);
        if(is_array($filter) || is_object($filter)){

            foreach($filter as $param_key => $param_value) {
                //echo $param_key;
                if (is_array($param_value))
                    $company->whereIn($param_key,$param_value);
                else
                    $company->where($param_key,$param_value);
            }
        }
        $company = $company->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"leave_type ".$range[0]."-".$range[1]."/".$companyCount)
            ->withJson(['data' => $company], 200);
    }
    
    // GET /leaves/{id}
    // Retrieve leaves data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo('GET /companies/'.$args['id']);
        $user = $request->getAttribute('user');
        $company = Company::find($args['id']);
        if ($company) {
            return $response->withJson([
                //'success' => true,
                'data' => $company
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'company not found'
            ], 400);
        }
    }
    

    
    // POST /leaves
    // Create leave type
    public function create(Request $request, Response $response) {
        $this->logger->addInfo('POST /companies');
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::companyPost());
        $this->logger->addInfo('POST valid /companies data '.  json_encode($data) );
        if ($validator->isValid()) {

        $newData = [];
        foreach($data as $key => $value){
            if($value)
                $newData[$key] = $value;
        }

            // Input is valid, so let's do something...
            $company =  Company::firstOrCreate($newData);
         
            $this->logger->addInfo('POST valid /companies '.  $company );
            
            return $response->withJson([
                'success' => true,
                'id' => $company->id
            ], 200);
        } else {
            // Validation error
            $this->logger->addInfo('POST not valid /companies ' );
            return $response->withJson([
                'success' => false,
                'errors' => $validator->getErrors()
            ], 400);
        }
    }
    
    // PUT /companies/{id}
    // Updates companies
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo('PUT /companies/'.$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::companyPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check company ID exists
        $company = Company::find($args['id']);
        if (!$errors && !$company) {
            $errors = ['companies not found: '.$args['id']];
        }
        // check for duplicate
        // if (!$errors && isset($data['name']) && $user->categories()->where('name', $data['name'])->where('id', '!=', $category->id)->first()) {
        //     $errors = ['Category name already exists'];
        // }

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
    
    // DELETE /companies/{id}
    // Delete a company
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $company = Company::withTrashed()->find($args['id']);
        if (!$errors && !$company) {
            $errors = ['Company not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $company->forceDelete() : $company->delete();
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