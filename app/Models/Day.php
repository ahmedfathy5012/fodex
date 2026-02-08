<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model 
{

    protected $table = 'days';
    public $timestamps = true;
    protected $guarded =[];
    //protected $visible = array('day_name');

}