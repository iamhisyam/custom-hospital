<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class LeaveTransRules {


     // POST /leaves_setup
     function leaveTransPost() {
        return [
            'employee_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /leaves_setup
    function leaveTransPut() {
        return [
            'employee_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid, status not selected'
                    ]

        ];  
    }


    // PUT /leaves_trans/{id}/approval
    function approvalLeaveTransPut() {
        return [
            'approval_status_code' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid'
                    ]

        ];  
    }

    // PUT /leaves_trans/{id}/approval
    function rejectLeaveTransPut() {
        return [
            'approval_status_code' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid'
                    ]

        ];  
    }

}

?>