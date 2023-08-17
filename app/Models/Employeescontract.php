<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employeescontract extends Model 
{

    protected $table = 'employeescontracts';
    public $timestamps = true;
    protected $fillable = array('id','from_day', 'to_day', 'creator_employee_id', 'employee_id', 'paper_contract_image', 'sallary', 'notes');
    protected $visible = array('id','from_day', 'to_day', 'creator_employee_id', 'employee_id', 'paper_contract_image', 'sallary', 'notes');

    public function employee()
    {
        return $this->belongsTo('Employee', 'employee_id');
    }

    public function creator_employee()
    {
        return $this->belongsTo('Employee', 'creator_employee_id');
    }

}