<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveTransDetail extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'leaves_trans_detail';
    protected $fillable = ['employee_code','leave_trans_id', 'day', 'year', 'month']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }
    public function leaveTrans() {
        return $this->belongsTo('\App\Models\LeaveTrans','leave_trans_id');
    }

}