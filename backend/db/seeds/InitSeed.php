<?php


use Phinx\Seed\AbstractSeed;

class InitSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        $data = [
            [
                'id' => '1',
                'code'    => '0',
                'name' => 'Super User',
            ],[
                'code'    => '1',
                'name' => 'Admin Dept',
            ],[
                'code'    => '2',
                'name' => 'User Approval',
            ],[
                'code'    => '3',
                'name' => 'Employee',
            ]

        ];

        $user_roles = $this->table('user_roles');
        $user_roles->insert($data)->save();



        $data = [
            [
                'username'    => 'hisyam',
                'password'    => '$2y$10$O6P9s8uNh6wN/NtpE7h1dODbhm..3g4G8/tVFr21WLQSvDLEmFqHO',
                'email'    => 'iam.ahmadhisyam@gmail.com',
                'name' => 'Ahmad Hisyam',
                'user_role_id' => '1',
            ]

        ];

        $users = $this->table('users');
        $users->insert($data)->save();


        $data = [
            [
                
                'code'    => '00001',
                'name' => 'GM',
                'level' => '10',
                'salary_min' => 100000000,
                'salary_mid' => 120000000,
                'salary_max' => 150000000,
            ],[
                'code'    => '00002',
                'name' => 'Controller',
                'level' => '20',
                'salary_min' => 10000000,
                'salary_mid' => 12000000,
                'salary_max' => 15000000,
                
            ],[
                'code'    => '00003',
                'name' => 'DIRECTOR',
                'level' => '30',
                'salary_min' => 10000000,
                'salary_mid' => 12000000,
                'salary_max' => 15000000,
            ],[
                'code'    => '00004',
                'name' => 'Manager',
                'level' => '40',
                'salary_min' => 8000000,
                'salary_mid' => 9000000,
                'salary_max' => 10000000,
            ],[
                'code'    => '00005',
                'name' => 'Dept Head',
                'level' => '50',
                'salary_min' => 6500000,
                'salary_mid' => 7000000,
                'salary_max' => 8000000,
            ],[
                'code'    => '00006',
                'name' => 'Supervisor',
                'level' => '60',
                'salary_min' => 5500000,
                'salary_mid' => 6000000,
                'salary_max' => 6500000,
            ],[
                'code'    => '00007',
                'name' => 'Staff',
                'level' => '70',
                'salary_min' => 4500000,
                'salary_mid' => 5000000,
                'salary_max' => 6000000,
            ]

        ];

        $grades = $this->table('grades');
        $grades->insert($data)->save();

        
        $data = [
            [
                'code'    => '0',
                'name' => 'Pending',
            ],[
                'code'    => '1',
                'name' => 'Approved',
            ],[
                'code'    => '2',
                'name' => 'Rejected',
            ]

        ];

        $leave_trans_status = $this->table('leave_trans_status');
        $leave_trans_status->insert($data)->save();

        $data = [
            [
                'code'    => '0',
                'name' => 'Leave Claim',
            ],[
                'code'    => '1',
                'name' => 'Leave Taken',
            ],[
                'code'    => '2',
                'name' => 'Leave Expired',
            ]

        ];

        $leave_trans_type = $this->table('leave_trans_type');
        $leave_trans_type->insert($data)->save();


        $data = [
            [
                'code'    => 'AL',
                'name' => 'Annual Leave',
            ],[
                'code'    => 'DO',
                'name' => 'Days Off',
            ]

        ];

        $leave_type = $this->table('leave_type');
        $leave_type->insert($data)->save();


        $data = [
            [
                'id'    => '1',
                'name'    => 'HEMATOLOGI',
                'description' => 'hematologi',
            ],
            [
                'id'    => '2',
                'name'    => 'URINALISA',
                'description' => 'urinalisa',
            ],
            [
                'id'    => '3',
                'name'    => 'KIMIA KLINIS',
                'description' => 'Kimia Klinis',
            ],
            [
                'id'    => '4',
                'name'    => 'IMMUNOLOGI/SEROLOGI',
                'description' => 'Immunologi/Serologi',
            ],
            [
                'id'    => '5',
                'name'    => 'LIVER PROFIL',
                'description' => 'Liver Profil',
            ],
           
            [
                'id'    => '6',
                'name'    => 'RENAL PROFIL',
                'description' => 'Renal Profil',
            ],
            [
                'id'    => '7',
                'name'    => 'LIPID PROFIL',
                'description' => 'Lipid Profil',
            ],

        ];

        $labs = $this->table('labs');
        $labs->insert($data)->save();


        $data = [
            [
                'lab_id' => '1',
                'name' => 'Hemoglobin',
                'measure' => 'g/dL',
                'normal_condition' => '13.2 - 17.3'
            ],
            [
                'lab_id' => '1',
                'name' => 'Leukosit',
                'measure' => 'ribu/µL',
                'normal_condition' => '3.80 - 10.60'
            ],
            [
                'lab_id' => '1',
                'name' => 'Hitung Jenis',
                'measure' => '',
                'normal_condition' => ''
            ],
            [
                'lab_id' => '1',
                'name' => 'Basofil',
                'measure' => '%',
                'normal_condition' => '0 - 1'
            ],
            [
                'lab_id' => '1',
                'name' => 'Eosinofil',
                'measure' => '%',
                'normal_condition' => '2 - 4'
            ],
            [
                'lab_id' => '1',
                'name' => 'Neutrofil Batang',
                'measure' => '%',
                'normal_condition' => '3 - 5'
            ],
            [
                'lab_id' => '1',
                'name' => 'Neutrofil Segmen',
                'measure' => '%',
                'normal_condition' => '50 - 70'
            ],
            [
                'lab_id' => '1',
                'name' => 'Limfosit',
                'measure' => '%',
                'normal_condition' => '25 - 40'
            ],
            [
                'lab_id' => '1',
                'name' => 'Monosit',
                'measure' => '%',
                'normal_condition' => '2 - 8'
            ],
            [
                'lab_id' => '1',
                'name' => 'Laju Endap darah',
                'measure' => 'mm',
                'normal_condition' => '0 - 10'
            ],
            [
                'lab_id' => '1',
                'name' => 'Trombosit',
                'measure' => 'ribu/µL',
                'normal_condition' => '150 - 440'
            ],
            [
                'lab_id' => '1',
                'name' => 'Hematokrit',
                'measure' => '%',
                'normal_condition' => '40 - 52'
            ],
            [
                'lab_id' => '1',
                'name' => 'Eritrosit',
                'measure' => "10˄6/µL",
                'normal_condition' => "4.40 - 5.90"
            ],
            [
                'lab_id' => '1',
                'name' => 'Jumlah Retikulosit',
                'measure' => "",
                'normal_condition' => ""
            ],
            [
                'lab_id' => '1',
                'name' => "Absolut",
                'measure' => "ribu/µL",
                
                'normal_condition' => "25 - 75"
            ],
            [
                'lab_id' => '1',
                'name' => "Persen",
                'measure' => "%",
                
                'normal_condition' => "0.50 - 2.00"
            ],
            [
                'lab_id' => '1',
                'name' => "MCV/VER",
                'measure' => "fL",
                
                'normal_condition' => "80 - 100"
            ],
            [
                'lab_id' => '1',
                'name' => "MCH/HER",
                'measure' => "pG",
                
                'normal_condition' => "26 - 34"
            ],
            [
                'lab_id' => '1',
                'name' => "MCHC/KHER",
                'measure' => "g/dL",
                
                'normal_condition' => "32 - 36"
            ],
            [
                'lab_id' => '2',
                'name' => "Warna",
                'measure' => "",
                
                'normal_condition' => "Kuning"
            ],
            [
                'lab_id' => '2',
                'name' => "Kejernihan",
                'measure' => "",
                
                'normal_condition' => "Jernih"
            ],
            [
                'lab_id' => '2',
                'name' => "Sedimen",
                'measure' => "",
                
                'normal_condition' => ""
            ],
            [
                'lab_id' => '2',
                'name' => "Leukosit",
                'measure' => "'/LPB",
                
                'normal_condition' => "0 - 5"
            ],
            [
                'lab_id' => '2',
                'name' => "Eritrosit",
                'measure' => "'/LPB",
                
                'normal_condition' => "˂= 3"
            ],
            [
                'lab_id' => '2',
                'name' => "Selinder",
                'measure' => "",
                
                'normal_condition' => ""
            ],
            [
                'lab_id' => '2',
                'name' => "Sel Epitel",
                'measure' => "",
                
                'normal_condition' => "(1+)"
            ],
            [
                'lab_id' => '2',
                'name' => "Kristal",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '2',
                'name' => "Bakteri",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '2',
                'name' => "Lain-lain",
                'measure' => "",
                
                'normal_condition' => ""
            ],
            [
                'lab_id' => '2',
                'name' => "Berat jenis",
                'measure' => "",
                
                'normal_condition' => "1.005 - 1.030"
            ],
            [
                'lab_id' => '2',
                'name' => "pH",
                'measure' => "",
                
                'normal_condition' => "5.0 - 7.0"
            ],
            [
                'lab_id' => '2',
                'name' => "Protein",
                'measure' => "mg/dL",
                
                'normal_condition' => "negatif (˂30)"
            ],
            [
                'lab_id' => '2',
                'name' => "Glukosa",
                'measure' => "mg/dL",
                
                'normal_condition' => "negatif (˂100)"
            ],
            [
                'lab_id' => '2',
                'name' => "Keton",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '2',
                'name' => "Darah Samar / Hb",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '2',
                'name' => "Bilirubin",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '2',
                'name' => "Urobilinogen",
                'measure' => "mg/dL",
                
                'normal_condition' => "0.2 - 1.0"
            ],
            [
                'lab_id' => '2',
                'name' => "Nitrit",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '2',
                'name' => "Leukosit esterase",
                'measure' => "",
                
                'normal_condition' => "(-) Negatif"
            ],
            [
                'lab_id' => '3',
                'name' => "Glukosa darah puasa",
                'measure' => "mg/dL",
                
                'normal_condition' => "70 - 110"
            ],
            [
                'lab_id' => '3',
                'name' => "Glukosa darah sewaktu",
                'measure' => "mg/dL",               
                'normal_condition' => ""
            ],
            [
                'lab_id' => '3',
                'name' => "Glukosa urin",
                'measure' => "mg/dL",               
                'normal_condition' => "(-) Negatif"
            ],

            [
                'lab_id' => '4',
                'name' => "HBsAg",
                'measure' => "",               
                'normal_condition' => "Non Reaktif"
            ],
            [
                'lab_id' => '4',
                'name' => "Anti HBs",
                'measure' => "",               
                'normal_condition' => "Non Reaktif"
            ],
            [
                'lab_id' => '4',
                'name' => "SD HIV 1/2",
                'measure' => "",               
                'normal_condition' => "Non Reaktif"
            ],
            [
                'lab_id' => '4',
                'name' => "ONCOPROBE HIV 1/2",
                'measure' => "S/CO",               
                'normal_condition' => "Non Reaktif"
            ],
            [
                'lab_id' => '4',
                'name' => "HIV 1/2 gO (Elisa)",
                'measure' => "",               
                'normal_condition' => "˂ 1.00 : non reaktif"
            ],
            [
                'lab_id' => '4',
                'name' => "Kesimpulan",
                'measure' => "",               
                'normal_condition' => ""
            ],
            [
                'lab_id' => '4',
                'name' => "Saran",
                'measure' => "",               
                'normal_condition' => ""
            ],

            [
                'lab_id' => '5',
                'name' => "SGOT (AST)",
                'measure' => "U/L",               
                'normal_condition' => "'10 - 34"
            ],
            [
                'lab_id' => '5',
                'name' => "SGPT (ALT)",
                'measure' => "U/L",               
                'normal_condition' => "'9 - 43"
            ],
            [
                'lab_id' => '5',
                'name' => "Fosfatase Alkali",
                'measure' => "U/L",               
                'normal_condition' => "'80 - 306"
            ],
            [
                'lab_id' => '5',
                'name' => "Protein Total",
                'measure' => "g/dL",               
                'normal_condition' => "'6.0 - 8.0"
            ],
            [
                'lab_id' => '5',
                'name' => "Albumin",
                'measure' => "g/dL",               
                'normal_condition' => "'4.0 - 5.2"
            ],
            [
                'lab_id' => '5',
                'name' => "Bilirubin Total",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 1.0"
            ],
            [
                'lab_id' => '5',
                'name' => "Bilirubin Direk",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 0.3"
            ],
            [
                'lab_id' => '5',
                'name' => "Bilirubin Indirek",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 0.8"
            ],
            [
                'lab_id' => '6',
                'name' => "Ureum Darah",
                'measure' => "mg/dL",               
                'normal_condition' => "'10 - 50"
            ],
            [
                'lab_id' => '6',
                'name' => "Kreatinin Darah",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 1.4"
            ],
            [
                'lab_id' => '6',
                'name' => "Asam Urat",
                'measure' => "mg/dL",               
                'normal_condition' => "3.0 - 7.0"
            ],

            [
                'lab_id' => '7',
                'name' => "Trigliserida",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 150"
            ],
            [
                'lab_id' => '7',
                'name' => "Kolesterol Total",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 200"
            ],
            [
                'lab_id' => '7',
                'name' => "Kolesterol HDL",
                'measure' => "mg/dL",               
                'normal_condition' => "42 - 67"
            ],
            [
                'lab_id' => '7',
                'name' => "Kolesterol LDL Direk",
                'measure' => "mg/dL",               
                'normal_condition' => "˂ 100"
            ],
        ];

        $labs_setup = $this->table('labs_setup');
        $labs_setup->insert($data)->save();

    }
}
