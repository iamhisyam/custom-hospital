<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LeaveBalanceRules {


     // POST /leaves_setup
     function leaveBalancePost() {
        return [
            'leave_setup_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /leaves_setup
    function leaveBalancePut() {
        return [
            'leave_setup_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>