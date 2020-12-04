<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalCheckup extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'medical_checkups';
    protected $fillable = [
        'code',
        'name',
        'provider',
        'patient_id',
        'company_id',
        'checkup_at',

        'height',
        'weight',
        'ideal_weight',
        'bmi',
        'nutrition_stat',
        'skin',
        'left_vision',
        'right_vision',
        'conjungtiva',
        'sclera',
        'pupil',
        'color_blind',
        'eye_ball',
        'cornea',

        'outer_ear',

        'nose',
        'tongue',
        'upper_teeth',
        'lower_teeth',
        'pharing',
        'tonsil',

        'blood_pressure',
        'pulse',
        'rhythm',
        'frequency',
        'lung',
        'vesiculer',
        'ronchi',
        'wheezing',
        'ekg',

        'audio_test',
        'usg',
        'treadmill',
        'conclusion',
        



    ]; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }

    public function patient() {
        return $this->belongsTo('\App\Models\Patient','patient_id');
    }

    public function labs_result(){
        return $this->hasMany('\App\Models\LabResult','patient_id');
    }

  
}