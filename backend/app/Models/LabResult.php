<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabResult extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'patient_labs_result';
    protected $fillable = ['patient_id','medical_checkup_id','lab_id']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }

    public function lab() {
        return $this->belongsTo('\App\Models\Lab','lab_id');
    }

    public function labs_test() {
        return $this->hasMany('\App\Models\LabTest', 'patient_lab_result_id');
    }

  
}