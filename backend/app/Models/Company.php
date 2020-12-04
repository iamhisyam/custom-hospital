<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'companies';
    protected $fillable = ['npwp','name','address', 'phone','city','zip','level','npp','kpa','max_npwp','kelurahan','kecamatan','klu','fax']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }
  
    
}