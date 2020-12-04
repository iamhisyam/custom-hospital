<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LabSetup as LabSetup;
use App\Includes\ValidationRules as ValidationRules;

class LabSetupController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "labs_setup";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('labs_setup');

    
    }
    
    // GET /branchs
    // Lists all branchs
    public function all(Request $request, Response $response) {
        $user = $request->getAttribute('user');

        $params = $request->getQueryParams();

        $filter = isset($params['filter'])?json_decode($params['filter']):[];
        $sort = isset($params['sort'])?json_decode($params['sort']):[];
        $range = isset($params['range'])?json_decode($params['range']):[];
        
        if(!$sort){$sort[0]="id";$sort[1]="asc";}
        if(!$range){$range[0]="0";$range[1]="0";}

        $take = $range[1]-$range[0]+1;
        
        $this->logger->addInfo("GET /$this->routeName");
       
        $dataCount = LabSetup::count();
        
        $query = LabSetup::query();

        foreach ($filter as $key => $value) {
            $query = $query->where($key,$value);
        }

        $lab_setup = $query->skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();

        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $lab_setup], 200);
    }
    
    // GET /branchs/{id}
    // Retrieve lab_setup data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $lab_setup = LabSetup::find($args['id']);
        if ($lab_setup) {
            return $response->withJson([
                //'success' => true,
                'data' => $lab_setup
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /branchs
    // Create lab_setup
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::branchPost());
        $this->logger->addInfo('POST valid /branchs data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if($value)
                    $newData[$key] = $value;
            }


            // Input is valid, so let's do something...
            $lab_setup =  LabSetup::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $lab_setup );
            
            return $response->withJson([
                'success' => true,
                'id' => $lab_setup->id
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
    
    // PUT /branchs/{id}
    // Updates branchs
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::branchPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check lab_setup ID exists
        $lab_setup = LabSetup::find($args['id']);
        if (!$errors && !$lab_setup) {
            $errors = ['branchs not found: '.$args['id']];
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
    
    // DELETE /branchs/{id}
    // Delete a lab_setup
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $lab_setup = LabSetup::withTrashed()->find($args['id']);
        if (!$errors && !$lab_setup) {
            $errors = ['LabSetup not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $lab_setup->forceDelete() : $lab_setup->delete();
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