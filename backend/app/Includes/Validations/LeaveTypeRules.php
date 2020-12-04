<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LeaveTypeRules {

     // POST /leave_type
     function leaveTypePost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /leaveType
    function leaveTypePut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>