<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class StateEmployee extends Model
{
   
    protected $table = 'states_employees';
    public $timestamps = true;
    protected $guarded =[];
}