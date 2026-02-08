<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\ZoneLatlon;
use App\Models\Order;
class Zone extends Model 
{

    protected $table = 'zones';
    public $timestamps = true;
    protected $fillable = array('id','name', 'country_id', 'state_id', 'city_id','lon','lat','text');
    protected $visible = array('id','name', 'country_id', 'state_id', 'city_id','lon','lat','text');
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
    }public function acceptorders(){
        return $this->hasMany(Order::class,'zone_id')->where("status",1);
    }public function areas(){
        return $this->hasMany(ZoneLatlon::class,'zone_id');
    }public function done_orders(){
        return $this->hasMany(Order::class,'zone_id')->where("status",3);
    }public function area(){
        return $this->hasOne(ZoneLatlon::class,'zone_id');
    }public function prices(){
        return $this->hasMany(ZonePrice::class,'zone_id');
    }

}