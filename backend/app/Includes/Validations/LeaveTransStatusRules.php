<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LeaveTransStatusRules {

     // POST /leave_trans_type
     function leaveTransStatusPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /leave_trans_status
    function leaveTransStatusPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>