<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabSetup extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'labs_setup';
    protected $fillable = ['name','measure','lab_id','normal_condition','description']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }



  
}