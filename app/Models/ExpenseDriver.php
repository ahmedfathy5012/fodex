<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
class ExpenseDriver extends Model
{
          protected $table = 'expenses_drivers';
    public $timestamps = true;
    protected $fillable = array('id','value','driver_id');
    protected $visible = array('id','value','driver_id');
    public function driver(){
        return $this->belongsTo(Driver::class,'driver_id');
    }
}
