<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Country;
use App\Models\Order;
class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('id','name', 'country_id', 'state_id', 'lon', 'lat','text');
    protected $visible = array('id','name', 'country_id', 'state_id', 'lon', 'lat','text');

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    } public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }


    public function address()
    {
        return $this->belongsTo('Address');
    }

    public function zones()
    {
        return $this->hasMany('Zone', 'zone_id');
    }public function acceptorders(){
        return $this->hasMany(Order::class,'city_id')->where("status",1);
    }public function done_orders(){
        return $this->hasMany(Order::class,'city_id')->where("status",3);
    }


}