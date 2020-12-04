<?php
namespace App\Includes;

use Respect\Validation\Validator as V;

class ValidationRules {
    function common() {
        return [
            'username' => V::length(3, 25)->alnum('-')->noWhitespace(),
            'password' => V::length(3, 25)->alnum('-')->noWhitespace()
        ];
    }



    // Company

     // POST /companies
     function companyPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // PUT /companies
    function companyPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // Branch

    // POST /branches
    function branchPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // PUT /branche
    function branchPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // Departments

    // POST /deparments
    function departmentPost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // PUT /deparments
    function departmentPut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }



    // POST /employees

    function employeePost() {
        return [
            'fullname' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
            ],'code' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
            ],

        ];

        
    }

    // PUT /employees

    function employeePut() {
        return [
            'fullname' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
            ],'code' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
            ],

        ];

        
    }

    // POST /leave type
    function leaveTypePost() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

   

    // PUT /leave type
    function leaveTypePut() {
        return [
            'name' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Name'
                    ]

        ];

        
    }

    // POST /leaves
    function leavesPost() {
        return [
            'application_date' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Date'
                    ],
            'start_date' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid Date'
            ],

            'end_date' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid Date'
            ],
        ];

        
    }

    // PUT /leaves
    function leavesPut() {
        return [
            'application_date' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Invalid Date'
                    ],
            'start_date' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid Date'
            ],

            'end_date' => [
                'rules' =>  V::notBlank(),
                'message' => 'Invalid Date'
            ],
        ];

        
    }


    // POST /categories
    function categoriesPost() {
        return [
            'name' => V::length(3, 25)->alnum('-')
        ];
    }
    
    // PUT /categories
    function categoriesPut() {
        return [
            'name' => [
                'rules' => V::optional(V::length(3, 25)->alnum('-')), // optional
                'message' => 'Invalid name' // custom error message (optional flag from rule supresses standard errors? suspicious of bug in awurth/slim-validation)
            ]
        ];
    }
    
    // POST /todo
    function todoPost() {
        return [
            'name' => V::length(3, 25)->alnum('-'),
            'category' => [
                'rules' => V::numeric()->positive(),
                'message' => 'Invalid category ID' // custom error message
            ]
        ];
    }
    
    // PUT /todo
    function todoPut() {
        return [
            'name' => [
                'rules' => V::optional(V::length(3, 25)->alnum('-')), // optional
                'message' => 'Invalid name'
            ],
            'category' => [
                'rules' => V::optional(V::numeric()->positive()), // optional
                'message' => 'Invalid category ID'
            ]
        ];
    }
    
    // POST /users
    function usersPost() {
        return [
            'username' => self::common()['username'],
            'password' => self::common()['password']
        ];
    }

    // PUT /users
    function usersPut() {
        return [
            'username' => self::common()['username']
        ];
    }
    
    
    // POST /auth
    function authPost() {
        return [
            'username' => self::common()['username'],
            'password' => self::common()['password']
        ];
    }
}
?>