<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CountryEmployee extends Model
{
   
    protected $table = 'countries_employees';
    public $timestamps = true;
    protected $guarded =[];
}