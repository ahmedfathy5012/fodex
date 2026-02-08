<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employeescontract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Address;
use App\Models\Order;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\Models\ExpenseEmployee;
use Laratrust\Traits\LaratrustUserTrait;
class Employee extends Authenticatable 
{
    use LaratrustUserTrait,Notifiable;
    protected $table = 'employees';
    public $timestamps = true;
    protected $guarded = [];
protected $appends = [
        'time_accept'
        
    ];
    public function countries(){
        return $this->belongsToMany(Country::class, 'countries_employees', 'employee_id', 'country_id');
     } 
   public function states(){
        return $this->belongsToMany(State::class, 'states_employees', 'employee_id', 'state_id');
     }public function cities(){
        return $this->belongsToMany(City::class, 'cities_employees', 'employee_id', 'city_id');
     }public function zones(){
        return $this->belongsToMany(Zone::class, 'zones_employees', 'employee_id', 'zone_id');
     }
    public function employeecontract()
    {
        return $this->hasOne(Employeescontract::class, 'employee_id');
    }

    public function employeesContractsCreating()
    {
        return $this->hasMany('Employeescontract', 'creator_employee_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'employee_id');
    }

    public function attendances()
    {
        return $this->hasMany('Attendance', 'employee_id');
    }

    public function sellerContracts()
    {
        return $this->hasMany('Sellercontract', 'employee_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo('Jobtitle', 'jobtitle_id');
    }

    public function genderType()
    {
        return $this->belongsTo('Gender', 'gender_id');
    }

    public function armyCase()
    {
        return $this->belongsTo('Armycase', 'armycase_id');
    }

    public function statusSocials()
    {
        return $this->belongsTo('Statussocials', 'statussocial_id');
    }public function expenses(){
        return $this->hasMany(ExpenseEmployee::class,'employee_id');
    }public function acceptorders(){
        return $this->hasMany(Order::class,'employee_id')->where("status",1);
    }public function getTimeAcceptAttribute(){
          $number = 0;
            $total = 0;
            $all = 0;
        if(count($this->acceptorders) > 0){
          
            foreach($this->acceptorders as $order){
             
                    // $accepted_at=\Carbon\Carbon::createFromTimestampUTC($order->accepted_at)->diffInMinutes();
                    // $created_at =\Carbon\Carbon::createFromTimestampUTC($order->created_at)->diffInMinutes();
                    // dd($created_at,$accepted_at);
                    $total += \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->accepted_at)->diffInMinutes(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at));
                   
                //  $total += $accepted_at -$created_at;
                  $number +=1;
                
            }
        }
        if($number != 0 && $total != 0){
            $all = $total / $number;
        }
        return $all;
    }public function getTypeAttribute(){
        if(count($this->countries) > 0){
            $type = 1;
        }elseif(count($this->states) > 0){
            $type = 2;
        }elseif(count($this->cities) > 0){
            $type = 3;
        }elseif(count($this->zones) > 0){
            $type = 4;
        }else{
             $type = 0;
        }
        return $type;
    }
   
}