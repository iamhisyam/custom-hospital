<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\MedicalCheckup as MedicalCheckup;
use App\Includes\Validations\MedicalCheckupRules as ValidationRules;

class MedicalCheckupController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "medical_checkups";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('medical_checkups');

    
    }
    
    // GET /medical_checkups
    // Lists all medical_checkups
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
       
        $dataCount = MedicalCheckup::count();
        
        $medical_checkup = MedicalCheckup::with('patient')->skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $medical_checkup], 200);
    }
    
    // GET /medical_checkups/{id}
    // Retrieve medical_checkup data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $medical_checkup = MedicalCheckup::with('patient','labs_result.lab','labs_result.labs_test')->find($args['id']);
        if ($medical_checkup) {
            return $response->withJson([
                //'success' => true,
                'data' => $medical_checkup
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /medical_checkups
    // Create medical_checkup
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::medicalCheckupPost());
        $this->logger->addInfo('POST valid /medical_checkups data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            foreach($data as $key => $value){
                if($value)
                    $newData[$key] = $value;
            }


            // Input is valid, so let's do something...
            $medical_checkup =  MedicalCheckup::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $medical_checkup );
            
            return $response->withJson([
                'success' => true,
                'id' => $medical_checkup->id
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
    
    // PUT /medical_checkups/{id}
    // Updates medical_checkups
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
        // check medical_checkup ID exists
        $medical_checkup = MedicalCheckup::find($args['id']);
        if (!$errors && !$medical_checkup) {
            $errors = ['medical_checkups not found: '.$args['id']];
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
    
    // DELETE /medical_checkups/{id}
    // Delete a medical_checkup
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $medical_checkup = MedicalCheckup::withTrashed()->find($args['id']);
        if (!$errors && !$medical_checkup) {
            $errors = ['MedicalCheckup not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $medical_checkup->forceDelete() : $medical_checkup->delete();
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