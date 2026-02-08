<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Order;
use App\Models\Coin;
class Country extends Model 
{

    protected $table = 'countries';
    public $timestamps = true;
    protected $fillable = array('id','name', 'lat', 'lon','coin_id','code','text');
    protected $visible = array('id','name', 'lat', 'lon','coin_id','code','text');

    public function states()
    {
        return $this->hasMany('State');
    }

    public function address()
    {
        return $this->belongsTo(Address::class,"country_id");
    } public function coin()
    {
        return $this->belongsTo(Coin::class,"coin_id");
    }public function acceptorders(){
        return $this->hasMany(Order::class,'country_id')->where("status",1);
    }public function done_orders(){
        return $this->hasMany(Order::class,'country_id')->where("status",3);
    }

}