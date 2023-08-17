<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Employee;
class ExpenseEmployee extends Model
{
      protected $table = 'expenses_employees';
    public $timestamps = true;
    protected $fillable = array('id','value','employee_id');
    protected $visible = array('id','value','employee_id');
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
