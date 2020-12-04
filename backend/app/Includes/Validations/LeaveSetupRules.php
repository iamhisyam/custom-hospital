<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LeaveSetupRules {


     // POST /leave_setup
     function leaveSetupPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /leave_setup
    function leaveSetupPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>