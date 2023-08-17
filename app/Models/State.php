<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\City;
use App\Models\Order;
class State extends Model 
{

    protected $table = 'states';
    public $timestamps = true;
    protected $fillable = array('name', 'country_id', 'lon',"text");
    protected $visible = array('id','name', 'country_id', 'lon',"text");

    public function cities()
    {
        return $this->hasMany(City::class,'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function address()
    {
        return $this->belongsTo('Address');
    }public function acceptorders(){
        return $this->hasMany(Order::class,'state_id')->where("status",1);
    }public function done_orders(){
        return $this->hasMany(Order::class,'state_id')->where("status",3);
    }


}