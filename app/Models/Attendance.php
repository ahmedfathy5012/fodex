<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model 
{

    protected $table = 'attendances';
    public $timestamps = true;
    protected $fillable = array('attend_from', 'attend_to', 'day_id', 'employee_id', 'notes', 'rest_from', 'rest_to', 'seconed_day_end');
    protected $visible = array('attend_from', 'attend_to', 'day_id', 'employee_id', 'notes', 'rest_from', 'rest_to', 'seconed_day_end');

    public function day()
    {
        return $this->belongsTo('Day', 'day_id');
    }

    public function employee()
    {
        return $this->belongsTo('Employee', 'employee_id');
    }

}