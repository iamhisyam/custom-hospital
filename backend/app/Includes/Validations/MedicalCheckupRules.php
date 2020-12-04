<?php
namespace App\Includes\Validations;

use Respect\Validation\Validator as V;

class MedicalCheckupRules {
    // MedicalCheckup

     // POST /medical_checkups
     function medicalCheckupPost() {
        return [
            'patient_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Patient must selected'
                    ]

        ];  
    }

    // PUT /medical_checkups
    function medicalCheckupPut() {
        return [
            'patient_id' => [
                        'rules' =>  V::notBlank(),
                        'message' => 'Patient must selected'
                    ]

        ];  
    }

}

?>