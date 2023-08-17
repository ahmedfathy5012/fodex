<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CityEmployee extends Model
{
   
    protected $table = 'cities_employees';
    public $timestamps = true;
    protected $guarded =[];
}