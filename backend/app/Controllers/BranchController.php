<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \App\Models\Branch as Branch;
use App\Includes\ValidationRules as ValidationRules;

class BranchController {
    private $logger;
    private $db;
    private $validator;
    
    private $table;

    private $routeName = "branches";

    // Dependency injection via constructor
    public function __construct($depLogger, $depDB, $depValidator) {
        $this->logger = $depLogger;
        $this->db = $depDB;
        $this->validator = $depValidator;
        $this->table = $this->db->table('branches');

    
    }
    
    // GET /branchs
    // Lists all branchs
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
       
        $dataCount = Branch::count();
        
        $branch = Branch::skip($range[0])->take($take)->orderBy($sort[0],$sort[1])->get();
        return $response
            ->withHeader('Content-Range',"$this->routeName ".$range[0]."-".$range[1]."/".$dataCount)
            ->withJson(['data' => $branch], 200);
    }
    
    // GET /branchs/{id}
    // Retrieve branch data by ID
    public function find(Request $request, Response $response, $args) {
        $this->logger->addInfo("GET /$this->routeName/".$args['id']);
        $user = $request->getAttribute('user');
        $branch = Branch::find($args['id']);
        if ($branch) {
            return $response->withJson([
                //'success' => true,
                'data' => $branch
            ], 200);
        } else {
            return $response->withJson([
                'success' => false,
                'errors' => 'data not found'
            ], 400);
        }
    }
    

    
    // POST /branchs
    // Create branch
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
            $branch =  Branch::firstOrCreate($newData);
         
            $this->logger->addInfo("POST valid /$this->routeName ".  $branch );
            
            return $response->withJson([
                'success' => true,
                'id' => $branch->id
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
        // check branch ID exists
        $branch = Branch::find($args['id']);
        if (!$errors && !$branch) {
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
    // Delete a branch
    public function delete(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $user = $request->getAttribute('user');
        $errors = [];
        // check category ID exists
        $branch = Branch::withTrashed()->find($args['id']);
        if (!$errors && !$branch) {
            $errors = ['Branch not found: '.$args['id']];
        }
        if (!$errors) {
            $deleted = (isset($data['force']) && !empty($data['force'])) ? $branch->forceDelete() : $branch->delete();
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