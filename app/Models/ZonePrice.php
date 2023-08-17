<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\ZoneLatlon;
use App\Models\Order;
class ZonePrice extends Model 
{

    protected $table = 'zone_prices';
    public $timestamps = true;
    protected $guarded = [];
  

}