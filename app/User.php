<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Address;
use App\Models\Order;
use App\Models\Seller;
use Laratrust\Traits\LaratrustUserTrait;
class User extends Authenticatable 
{
    use LaratrustUserTrait;
    use Notifiable;

    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

  
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
    public function address()
    {
        return $this->hasOne(Address::class, 'user_id')->where("active",1);
    }

    public function userType()
    {
        return $this->belongsTo('Usertype', 'usertype_id');
    }

    public function wallets()
    {
        return $this->hasMany('Userwallet', 'user_id');
    }public function acceptorders(){
        return $this->hasMany(Order::class,'user_id')->where("status",1);
    }public function favorite_sellers(){
        return $this->belongsToMany(Seller::class,"favorite_sellers","user_id","seller_id");
    }public function done_orders(){
        return $this->hasMany(Order::class,'user_id')->where("status",3);
    }
}
