<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class UserRoleRules {
    // User Roles

     // POST /user_roles
     function userRolePost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }
}

?>