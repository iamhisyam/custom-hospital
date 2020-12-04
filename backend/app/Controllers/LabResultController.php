<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\LabResult as LabResult;
use \App\Models\LabTest as LabTest;
use \App\Models\MedicalCheckup as MedicalCheckup;
use App\Includes\Validations\LabsResultRules as ValidationRules;

class LabResultController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "labs_result";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('patient_labs_result');

    
    }
    
    // GET /labs_result
    // Lists all labs_result
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
       
        $dataCount = LabResult::count();
        
        $lab_result = LabResult::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $lab_result], 200);
    }
    
    // GET /labs_result/{id}
    // Retrieve lab_result data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $lab_result = LabResult::with('labs_test')->find($args['id']);
        if ($lab_result) {
            return $response->withJson([
                //'success' => true,
                'data' => $lab_result
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /labs_result
    // Create lab_result
    public function create(Request $request, Response $response) {
        $this->logger->addInfo("POST /$this->routeName");
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
    
        // The validate method returns the validator instance
        $validator = $this->validator->validate($request, ValidationRules::labsResultPost());
        $this->logger->addInfo('POST valid /labs_result data '.  json_encode($data) );
        if ($validator->isValid()) {

            $newData = [];
            $labs_test = [];
            foreach($data as $key => $value){
                if($value)
                    $newData[$key] = $value;
            }

            $medical_checkup = MedicalCheckup::find($newData['medical_checkup_id']);
            $patient_id = $medical_checkup->patient_id;
            $newData['patient_id'] = $patient_id;

            $labs_test = $newData['labs_test'];
            unset($newData['labs_test']);

            $lab_result = LabResult::where('medical_checkup_id',$newData['medical_checkup_id'])
                                    ->where('lab_id',$newData['lab_id'])->first();
            
            $lab_result_exist = $lab_result->id;

            if(!empty($lab_result_exist))
                return $response->withJson([
                    'success' => false,
                    'errors' => 'data existed',
                    
                ], 400);


            // Input is valid, so let's do something...
            $lab_result =  LabResult::firstOrCreate($newData);

            $this->logger->addInfo('DB save success /labs_result data '.  json_encode($lab_result) );

            $newDataLabTest = [];
            $labs_test_result_ids = [];
            $patient_lab_result_id = $lab_result->id;

            if($patient_lab_result_id){
                foreach ($labs_test as $id => $item) {
    
                        $newDataLabTest[$id]["patient_lab_result_id"] = $patient_lab_result_id;
                        $newDataLabTest[$id]["name"] = $item["name"];
                        $newDataLabTest[$id]["measure"] = $item["measure"];
                        $newDataLabTest[$id]["value"] = $item["value"];
                        $newDataLabTest[$id]["normal_condition"] = $item["normal_condition"];

                        $lab_test = LabTest::firstOrCreate($newDataLabTest[$id]);

                        if($lab_test->id) array_push($labs_test_result_ids,$lab_test->id);

                }
            }
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $lab_result );
            
            return $response->withJson([
                'success' => true,
                'id' => $labs_test_result_ids
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
    
    // PUT /labs_result/{id}
    // Updates labs_result
    public function update(Request $request, Response $response, $args) {
        
        $this->logger->addInfo("PUT /$this->routeName/".$args['id']);
        
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // validate inputs
        $validator = $this->validator->validate($request, ValidationRules::labsResultPut());
        if (!$validator->isValid()) {
            $errors = $validator->getErrors();
        }
        // check lab_result ID exists
        $lab_result = LabResult::find($args['id']);
        if (!$errors && !$lab_result) {
            $errors = ['labs_result not found: '.$args['id']];
        }
        // check for duplicate
        // if (!$errors && isset($data['name']) && $user->categories()->where('name', $data['name'])->where('id', '!=', $category->id)->first()) {
        //     $errors = ['Category name already exists'];
        // }
        // No errors? Update DB
        $updatedData = [];
        $updatedLabTest = []; 
        $labs_test_result_ids = [];
        $patient_lab_result_id = $lab_result->id;
        
        
        foreach($data as $key => $value){
            if($value)
                $updatedData[$key] = $value;
        }
        $labs_test = $updatedData['labs_test'];
        if($patient_lab_result_id){
            foreach ($labs_test as $id => $item) {
                    $updatedLabTest[$id]["id"] = $item["id"];
                    $updatedLabTest[$id]["patient_lab_result_id"] = $patient_lab_result_id;
                    $updatedLabTest[$id]["name"] = $item["name"];
                    $updatedLabTest[$id]["measure"] = $item["measure"];
                    $updatedLabTest[$id]["value"] = $item["value"];
                    $lab_test = LabTest::where('id',$item["id"])->update($updatedLabTest[$id]);
                    if($lab_test->id) array_push($labs_test_result_ids,$lab_test->id);

            }
        }
        unset($updatedData['labs_test']);
        // No errors? Update DB
        if (!$errors && $updatedData) {
            $rs = $this->table->where('id',$args['id'])->update($updatedData);        
            return $response->withJson(['success' => true,'id'=>$args['id'],'ids'=>$labs_test_result_ids,'lb'=>$updatedLabTest], 200);
        } else {
            // Errors found
            return $response->withJson([
                'success' => false,
                'errors' => $errors
            ], 400);
        }
    }
    
    // DELETE /labs_result/{id}
    // Delete a lab_result
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $lab_result = LabResult::withTrashed()->find($args['id']);
        if (!$errors && !$lab_result) {
            $errors = ['LabResult not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $lab_result->forceDelete() : $lab_result->delete();
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