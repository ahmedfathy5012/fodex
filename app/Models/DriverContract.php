<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverContract extends Model 
{

    protected $table = 'driverscontracts';
    public $timestamps = true;
    protected $fillable = array('id','from_day', 'to_day', 'creator_employee_id', 'driver_id', 'paper_contract_image', 'sallary', 'notes');
    protected $visible = array('id','from_day', 'to_day', 'creator_employee_id', 'driver_id', 'paper_contract_image', 'sallary', 'notes');

    public function driver()
    {
        return $this->belongsTo('Driver', 'driver_id');
    }

    public function creator_employee()
    {
        return $this->belongsTo('Employee', 'creator_employee_id');
    }

}