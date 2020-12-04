<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'grades';
    protected $fillable = ['code','name','level','salary_min','salary_mid','salary_max']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }

    public function leaveSetup() {
        return $this->hasMany('\App\Models\LeaveSetup', 'grade_id');
    }


  
}