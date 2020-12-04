<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'employees';
    protected $fillable =  [
                            'code',
                            'company_id',
                            'npwp',
                            'branch_id',
                            'department_id',
                            'position_id',
                            'team_id',
                            'grade_id',
                            'fullname',
                            'join_at',
                            'resign_at',
                            'employment',
                            'employment_type',
                            'salary',
                            'religion',
                            'status',
                            'sex',
                            'email',
                            'password',
                            'point'
     
                        ]; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }

    public function company() {
        return $this->belongsTo('\App\Models\Company','company_id');
    }

    public function branch() {
        return $this->belongsTo('\App\Models\Branch','branch_id');
    }

    public function team() {
        return $this->belongsTo('\App\Models\Team','team_id');
    }

    public function grade() {
        return $this->belongsTo('\App\Models\Grade','grade_id');
    }

    public function position() {
        return $this->belongsTo('\App\Models\Position','position_id');
    }

    

  
}