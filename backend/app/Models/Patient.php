<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'patients';
    protected $fillable = [
        'code',
        'name',
        'company_id',
        'branch_id',
        'department_id',

        'address',
        'phone',
        'city',
        'kelurahan',
        'kecamatan',
        'zip',
        'fax',

        'ever_had_disease',
        'ever_had_treated',
        'ever_had_surgery',
        'ever_had_accident',

        'smoking_habit',
        'alcohol_habit',
        'coffe_habit',
        'exercise_habit',

        'had_hypertension',
        'had_diabetes',
        'had_heart_disease',
        'had_kidney_disease',
        'had_mentally_ill',

        'is_being_treated',
        'long_being_sick',
        'being_sick',
        'sickness'


    ]; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }



  
}