<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LabsResultRules {
    // Grade

     // POST /labs_test
     function labsResultPost() {
        return [
            'medical_checkup_id' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid Name'
            ],
            'lab_id' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid Name'
            ],

        ];  
    }

    // PUT /labs_test
    function labsResultPut() {
        return [
            'medical_checkup_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid medical checkup id'
            ],
            'lab_id' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid lab id'
            ]

        ];  
    }

}

?>