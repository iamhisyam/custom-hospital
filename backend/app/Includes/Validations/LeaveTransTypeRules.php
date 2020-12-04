<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LeaveTransTypeRules {

     // POST /leave_trans_type
     function leaveTransTypePost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /leave_trans_type
    function leaveTransTypePut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>