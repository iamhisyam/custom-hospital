<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class GradeRules {
    // Grade

     // POST /grades
     function gradePost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /grades
    function gradePut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>