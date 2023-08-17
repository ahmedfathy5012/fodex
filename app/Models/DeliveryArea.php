<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\ZoneLatlon;
use App\Models\Order;
class DeliveryArea extends Model 
{

    protected $table = 'delivery_areas';
    public $timestamps = true;
    protected $guarded = [];
   public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    } public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
public function areas(){
        return $this->hasMany(DeliveryAreaLatlon::class,'delivery_area_id');
    }
}