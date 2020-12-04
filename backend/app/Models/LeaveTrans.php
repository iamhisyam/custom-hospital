<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveTrans extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'leaves_trans';
    protected $fillable = [
                            'employee_id',
                            'leave_type_id', 
                            'leave_trans_type_id', 
                            'leave_trans_status_id', 
                            'reason', 
                            'application_date', 
                            'start_date', 
                            'end_date',
                            'year',
                            'month',
                            'is_approved',
                            'approved_by',
                            'created_by',
                            'updated_by',
                        ]; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }

    public function employee() {
        return $this->belongsTo('\App\Models\Employee','employee_id');
    }

    public function leaveType() {
        return $this->belongsTo('\App\Models\LeaveType','leave_type_id');
    }

    public function leaveTransType() {
        return $this->belongsTo('\App\Models\LeaveTransType','leave_trans_type_id');
    }

    public function leaveTransStatus() {
        return $this->belongsTo('\App\Models\LeaveTransStatus','leave_trans_status_id');
    }

}