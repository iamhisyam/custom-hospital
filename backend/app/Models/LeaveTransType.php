<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveTransType extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'leave_trans_type';
    protected $fillable = ['code','name']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        // setup model event listeners
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
        // static::deleting(['\App\Models\Events\Category', 'delete']); // DELETE event listener
    }

}