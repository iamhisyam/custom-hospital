<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class HolidayRules {
    // Holiday

     // POST /holidays
     function holidayPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /holidays
    function holidayPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>