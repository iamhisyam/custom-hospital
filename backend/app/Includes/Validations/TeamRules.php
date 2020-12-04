<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class TeamRules {
    // Teams

     // POST /teams
     function teamPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // PUT /teams
    function teamPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }
}

?>