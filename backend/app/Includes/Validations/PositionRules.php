<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class PositionRules {
    // Position

     // POST /positions
     function positionPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

    // PUT /positions
    function positionPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];  
    }

}

?>