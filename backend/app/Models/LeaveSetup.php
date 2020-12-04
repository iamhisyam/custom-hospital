<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveSetup extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'leave_setup';
    protected $fillable = ['code','name', 'grade_id','leave_type_id', 'year', 'days_per_year', 'days_per_month','days', 'expire_count']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }
    public function grade() {
        return $this->belongsTo('\App\Models\Grade','grade_id');
    }

    public function leaveType() {
        return $this->belongsTo('\App\Models\LeaveType','leave_type_id');
    }

}