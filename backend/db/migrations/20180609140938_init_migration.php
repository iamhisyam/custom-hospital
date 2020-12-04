<?php


use Phinx\Migration\AbstractMigration;

class InitMigration extends AbstractMigration
{
    public function change() {
          
         //user roles
         $table = $this->table('user_roles', [ 'primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 5])
                ->addColumn('name', 'string', ['limit' => 20])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])
                ->create();
                        
        // users
        $table = $this->table('users', ['primary_key' => ['username', 'email']])
                ->addColumn('username', 'string', ['limit' => 20])
                ->addColumn('password', 'string', ['limit' => 100])
                ->addColumn('email', 'string', ['limit' => 50])
                ->addColumn('user_role_id', 'integer', [ 'null' => true])
                ->addColumn('name', 'string', ['limit' => 100])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])  
                ->addIndex(['username', 'email'], ['unique' => true])  
                ->addForeignKey('user_role_id', 'user_roles', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])      
                ->create();  

        // settings
        $table = $this->table('settings')
                ->addColumn('key', 'string', ['limit' => 20])
                ->addColumn('value', 'string', ['limit' => 100])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['key'], ['unique' => true])
                ->create();
        

        // Companies
        $table = $this->table('companies', ['primary_key' => ['npwp']])
                ->addColumn('name', 'string', ['limit' => 100])
                ->addColumn('address', 'string', ['limit' => 250])
                ->addColumn('phone', 'string', ['limit' => 20])            
                ->addColumn('npwp', 'string', ['limit' => 15])
                ->addColumn('city', 'string', ['limit' => 30])
                ->addColumn('zip', 'string', ['limit' => 5])
                ->addColumn('level', 'string', ['limit' => 1])
                ->addColumn('npp', 'string', ['limit' => 15])
                ->addColumn('kpa', 'string', ['limit' => 15])
                ->addColumn('max_npwp', 'integer')
                ->addColumn('kelurahan', 'string', ['limit' => 40])
                ->addColumn('kecamatan', 'string', ['limit' => 40])
                ->addColumn('klu', 'string', ['limit' => 5])
                ->addColumn('fax', 'string', ['limit' => 5])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['npwp'], ['unique' => true])
                ->create();
         
       // Branches
        $table = $this->table('branches', [ 'primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 5])
                ->addColumn('company_id', 'integer',['null' => true])
                ->addColumn('branch_id', 'integer', ['null'=> true])
                ->addColumn('level','integer',['null' => true])
                ->addColumn('name', 'string', ['limit' => 30])
                ->addColumn('address', 'string', ['limit' => 100])
                ->addColumn('phone', 'string', ['limit' => 20])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addForeignKey('company_id', 'companies', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('branch_id', 'branches', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addIndex(['code'], ['unique' => true])
                ->create();

        // Departments
        $table = $this->table('departments',[ 'primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 5])
                ->addColumn('branch_id','integer', ['null'=> true])
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addForeignKey('branch_id', 'branches', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addIndex(['code'], ['unique' => true])

                ->create();
                  
        
        //positions
        $table = $this->table('positions', ['primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 5])
                ->addColumn('name', 'string', ['limit' => 20])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])

                ->create();

        //teams
        $table = $this->table('teams', [ 'primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 10])
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])
                ->create();

        //Grades
        $table = $this->table('grades', [ 'primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 10])
                ->addColumn('name', 'string', ['limit' => 35])
                ->addColumn('level', 'integer')
                ->addColumn('salary_min', 'decimal', ['precision'=> 19,'scale'=>0])
                ->addColumn('salary_mid', 'decimal', ['precision'=> 19,'scale'=>0])
                ->addColumn('salary_max', 'decimal', ['precision'=> 19,'scale'=>0])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])

                ->create();

        // Employee
        $table = $this->table('employees', ['primary_key' => ['code','npwp']])               
                ->addColumn('code', 'string', ['limit' => 30])
                ->addColumn('npwp', 'string', ['limit' => 15, 'null'=> true])
                ->addColumn('company_id', 'integer',['null' => true])    
                ->addColumn('branch_id', 'integer',['null' => true])
                ->addColumn('department_id', 'integer',['null' => true])                         
                ->addColumn('position_id', 'integer',['null' => true])
                ->addColumn('team_id', 'integer',['null' => true])
                ->addColumn('grade_id', 'integer',['null' => true])
                ->addColumn('fullname', 'string', ['limit' => 50])
                ->addColumn('join_at', 'date')
                ->addColumn('resign_at', 'date',['null' => true])
                ->addColumn('employment', 'string',['limit' => 2,'null'=>true])
                ->addColumn('employment_type', 'integer',['null'=>true])
                ->addColumn('salary', 'decimal', ['precision'=>19,'scale'=>4])
                ->addColumn('religion', 'string', ['limit' => 15])
                ->addColumn('status', 'string', ['limit' => 3])
                ->addColumn('sex', 'string', ['limit' => 1])
                ->addColumn('email', 'string', ['limit' => 50 ])
                ->addColumn('password', 'string', ['limit' => 100, 'null' => true ])
                ->addColumn('point', 'integer')
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                
                ->addForeignKey('company_id', 'companies', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('branch_id', 'branches', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('department_id', 'departments', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('position_id', 'positions', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('team_id', 'teams', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('grade_id', 'grades', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])

                ->addIndex(['code','npwp'], ['unique' => true])
                ->create();

        
        // leave type
        $table = $this->table('leave_type', ['primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 5])
                ->addColumn('name', 'string', ['limit' => 30])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])
                ->create();
        // leave setup
        $table = $this->table('leave_setup', ['primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 5])
                ->addColumn('name', 'string', ['limit' => 30])
                ->addColumn('grade_id', 'integer', ['null'=> true])
                ->addColumn('leave_type_id', 'integer', ['null'=> true])              
                ->addColumn('year','year')
                ->addColumn('days_per_year', 'integer')
                ->addColumn('days_per_month','integer')
                ->addColumn('days','integer')
                ->addColumn('expire_count','integer')
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addForeignKey('grade_id', 'grades', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('leave_type_id', 'leave_type', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addIndex(['code'], ['unique' => true])
                ->create();


        // leave trans type
        $table = $this->table('leave_trans_type', ['primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 1])
                ->addColumn('name', 'string', ['limit' => 30])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])
                ->create();

        // leave trans status
        $table = $this->table('leave_trans_status', ['primary_key' => ['code']])
                ->addColumn('code', 'string', ['limit' => 1])
                ->addColumn('name', 'string', ['limit' => 30])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['code'], ['unique' => true])
                ->create();

        // leave balance
        $table = $this->table('leaves_balance')
                ->addColumn('employee_id','integer', [ 'null' => true])
                ->addColumn('leave_setup_id','integer', [ 'null' => true])
                ->addColumn('leave_setup_code', 'string', ['limit' => 5, 'null' => true])
                ->addColumn('year','year')
                ->addColumn('month','integer')
                ->addColumn('days','integer')
                ->addColumn('valid_at','date')
                ->addColumn('expired_at','date')
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addForeignKey('employee_id', 'employees', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('leave_setup_id', 'leave_setup', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])

                ->create();

        // leaves trans
        $table = $this->table('leaves_trans')             
                ->addColumn('employee_id','integer', ['null' => true])
                ->addColumn('leave_type_id','integer', ['null' => true])
                ->addColumn('leave_trans_type_id','integer', ['null' => true])
                ->addColumn('leave_trans_status_id','integer', ['null' => true])
                ->addColumn('reason', 'string', ['limit' => 150])
                ->addColumn('application_date','date')
                ->addColumn('start_date','date')
                ->addColumn('end_date','date')
                ->addColumn('year','year', ['null' => true])
                ->addColumn('month','integer', ['null' => true])
                ->addColumn('holiday_count','integer', ['null' => true])
                ->addColumn('previous_balance','integer', ['null' => true])
                ->addColumn('balance','integer', ['null' => true])
                ->addColumn('is_approved', 'boolean', ['default' => 0])
                ->addColumn('approved_by', 'integer',['null' => true])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['id'], ['unique' => true])
                ->addForeignKey('employee_id', 'employees', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('leave_type_id', 'leave_type', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('leave_trans_type_id', 'leave_trans_type', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->addForeignKey('leave_trans_status_id', 'leave_trans_status', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
                ->create();
        
  
        //holidays
        $table = $this->table('holidays')
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('start_date', 'date')
                ->addColumn('end_date', 'date')
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();

        //patients
        $table = $this->table('patients')
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('code', 'string')
                ->addColumn('company_id', 'integer',['null' => true])
                ->addColumn('branch_id', 'integer',['null' => true])
                ->addColumn('department_id', 'integer',['null' => true])

                ->addColumn('address', 'string', ['limit' => 150,'null' => true])
                ->addColumn('phone', 'string', ['limit' => 50,'null' => true])
                ->addColumn('city', 'string', ['limit' => 30,'null' => true])
                ->addColumn('kelurahan', 'string', ['limit' => 50,'null' => true])
                ->addColumn('kecamatan', 'string', ['limit' => 50,'null' => true])
                ->addColumn('zip', 'string', ['limit' => 50,'null' => true])
                ->addColumn('fax', 'string', ['limit' => 50,'null' => true])


                ->addColumn('ever_had_disease', 'boolean',['null' => true])
                ->addColumn('ever_had_treated', 'boolean',['null' => true])
                ->addColumn('ever_had_surgery', 'boolean',['null' => true])
                ->addColumn('ever_had_accident', 'boolean',['null' => true])

                ->addColumn('smoking_habit', 'boolean',['null' => true])
                ->addColumn('alcohol_habit', 'boolean',['null' => true])
                ->addColumn('coffe_habit', 'boolean',['null' => true])
                ->addColumn('exercise_habit', 'boolean',['null' => true])

                ->addColumn('had_hypertension', 'boolean',['null' => true])
                ->addColumn('had_diabetes', 'boolean',['null' => true])
                ->addColumn('had_heart_disease', 'boolean',['null' => true])
                ->addColumn('had_kidney_disease', 'boolean',['null' => true])
                ->addColumn('had_mentally_ill', 'boolean',['null' => true])

                ->addColumn('is_being_treated', 'boolean',['null' => true])
                ->addColumn('long_being_sick', 'integer',['null' => true])
                ->addColumn('being_sick', 'boolean',['null' => true])
                ->addColumn('sickness', 'string',['limit'=>50,'null' => true])
                

                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();



        //check ups
        $table = $this->table('medical_checkups')
                ->addColumn('code', 'string', ['limit' => 30, 'null' => true])
                ->addColumn('name', 'string', ['limit' => 50, 'null' => true])
                ->addColumn('provider', 'string', ['limit' => 50 ,'null' => true])
                ->addColumn('company_id', 'integer', ['default' => 0])

                ->addColumn('patient_id', 'integer')
                ->addColumn('checkup_at', 'date')

                //general
                ->addColumn('height', 'integer', ['null' => true])
                ->addColumn('weight', 'integer', ['null' => true])
                ->addColumn('ideal_weight', 'integer', ['null' => true])
                ->addColumn('bmi', 'integer', ['null' => true])
                ->addColumn('nutrition_stat', 'string', ['limit' => 50,'null' => true,'null' => true])
                ->addColumn('skin', 'string', ['limit' => 50,'null' => true])

                //eyes
                ->addColumn('left_vision', 'string', ['limit' => 50,'null' => true])
                ->addColumn('right_vision', 'string', ['limit' => 50,'null' => true])
                ->addColumn('conjungtiva', 'string', ['limit' => 50,'null' => true])
                ->addColumn('sclera', 'string', ['limit' => 50,'null' => true])
                ->addColumn('pupil', 'string', ['limit' => 50,'null' => true])
                ->addColumn('color_blind', 'string', ['limit' => 50,'null' => true])
                ->addColumn('eye_ball', 'string', ['limit' => 50,'null' => true])
                ->addColumn('cornea', 'string', ['limit' => 50,'null' => true])

                //ears
                ->addColumn('outer_ear', 'string', ['limit' => 50,'null' => true])

                //nose , mouth , neck
                ->addColumn('nose', 'string', ['limit' => 50,'null' => true])
                ->addColumn('tongue', 'string', ['limit' => 50,'null' => true])
                ->addColumn('upper_teeth', 'string', ['limit' => 50,'null' => true])
                ->addColumn('lower_teeth', 'string', ['limit' => 50,'null' => true])
                ->addColumn('pharing', 'string', ['limit' => 50,'null' => true])
                ->addColumn('tonsil', 'string', ['limit' => 50,'null' => true])

                //kardiovaskuler
                ->addColumn('blood_pressure', 'string', ['limit' => 20,'null' => true])
                ->addColumn('pulse', 'string', ['limit' => 30,'null' => true])
                ->addColumn('rhythm', 'string', ['limit' => 20,'null' => true])

                //respiration
                ->addColumn('frequency', 'string', ['limit' => 30,'null' => true])
                ->addColumn('lung', 'string', ['limit' => 30,'null' => true])
                ->addColumn('vesiculer', 'string', ['limit' => 30,'null' => true])
                ->addColumn('ronchi', 'string', ['limit' => 30,'null' => true])
                ->addColumn('wheezing', 'string', ['limit' => 30,'null' => true])

                //other
                ->addColumn('ekg', 'string', ['limit' => 50,'null' => true])
                ->addColumn('audio_test', 'string', ['limit' => 50,'null' => true])
                ->addColumn('usg', 'string', ['limit' => 50,'null' => true])
                ->addColumn('treadmill', 'string', ['limit' => 50,'null' => true])


                ->addColumn('conclusion', 'text', ['null' => true])
                

                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();
    
        // labs 
        $table = $this->table('labs')
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('description', 'text')
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();

        // labs setup
        $table = $this->table('labs_setup')
                ->addColumn('lab_id', 'integer')
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('measure',  'string', ['limit' => 50,'null' => true])
                ->addColumn('normal_condition',  'string', ['limit' => 100,'null' => true])
                ->addColumn('description',  'string', ['limit' => 150,'null' => true])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();
        

        // patient lab result
        $table = $this->table('patient_labs_result')
                ->addColumn('patient_id', 'integer')
                ->addColumn('lab_id', 'integer')
                ->addColumn('medical_checkup_id', 'integer')                
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();
       
        // labs test
        $table = $this->table('labs_test')
                ->addColumn('patient_lab_result_id', 'integer')
                ->addColumn('name', 'string', ['limit' => 50])
                ->addColumn('measure',  'string', ['limit' => 50,'null' => true])
                ->addColumn('value',  'string', ['limit' => 50,'null' => true])
                ->addColumn('normal_condition',  'string', ['limit' => 100,'null' => true])
                ->addColumn('created_by', 'integer', ['null' => true])
                ->addColumn('updated_by', 'integer', ['null' => true])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp', ['null' => true])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->create();
                
    }
}
