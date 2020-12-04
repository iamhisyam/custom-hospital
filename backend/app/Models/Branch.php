<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model {
    use SoftDeletes; // toggle soft deletes
    protected $table = 'branches';
    protected $fillable = ['code','company_id','branch_id','level','address','phone','name']; // for mass creation
    protected $hidden = ['deleted_at']; // hidden columns from select results
    protected $dates = ['deleted_at']; // the attributes that should be mutated to dates
    public static function boot() {
        parent::boot();
        static::setEventDispatcher(new \Illuminate\Events\Dispatcher());
    }

    public function company() {
        return $this->belongsTo('\App\Models\Company','npwp_company');
    }

  
}