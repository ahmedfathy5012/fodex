<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\ExpenseDriver;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Address;
use Carbon\Carbon;

class Driver extends Authenticatable
{

    protected $table = 'drivers';
    public $timestamps = true;
    protected $guarded = [];
    public function genderType()
    {
        return $this->belongsTo('Gender', 'gender_id');
    }

    public function armyCase()
    {
        return $this->belongsTo('Armycase', 'armycase_id');
    }

    public function statusSocial()
    {
        return $this->belongsTo('Statussocials', 'statussocial_id');
    }public function dorders(){
        return $this->hasMany(Order::class,'driver_id');
    }public function acceptorders(){
        return $this->hasMany(Order::class,'driver_id')->where("status",1);
    }public function refusedorders(){
        return $this->hasMany(Order::class,'driver_id')->where("cancel",1);
    }public function expenses(){
        return $this->hasMany(ExpenseDriver::class,'driver_id');
    }
    public function address()
    {
        return $this->hasOne(Address::class, 'driver_id');
    }
    public function orders_ongoing(){
        return $this->hasMany(Order::class,"driver_id")->where("status",2);
    }
    public function done_orders(){
        return $this->hasMany(Order::class,'driver_id')->where("status",3);
    }
    // public function getAvailableAttribute(){
    //     $available = 0;
    
    //     if($this->start_shift && $this->end_shift){
    //         $start_shift = Carbon::parse($this->start_shift)->format('H:i:s');
    //       $end_shift = Carbon::parse($this->end_shift)->format('H:i:s');
    //      $now =  Carbon::now()->format('H:i:s');
    //      if($start_shift < $now && $end_shift >  $now){
    //          $available = 1;
    //      }
    //     }
    //     return $available;
    // }  

public function my_drivers(){
    return $this->hasMany(self::class,"driver_id");
}
public function company(){
    return $this->belongsTo(self::class,"driver_id");
}
  public function company_done_orders(){
        return $this->hasMany(Order::class,'company_id')->where("status",3);
    }

   public function zones(){
        return $this->belongsToMany(Zone::class, 'driver_zones', 'driver_id', 'zone_id');
    }

}