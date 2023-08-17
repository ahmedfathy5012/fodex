<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\Models\Seller;
class Coupon extends Model
{
     protected $guarded = [];
    protected $table = "coupons";
        public $timestamps = false;
    public function countries(){
        return $this->belongsToMany(Country::class, 'coupons_countries', 'coupon_id', 'country_id');
    } public function states(){
        return $this->belongsToMany(State::class, 'coupons_states', 'coupon_id', 'state_id');
    } public function cities(){
        return $this->belongsToMany(City::class, 'coupons_cities', 'coupon_id', 'city_id');
    } public function zones(){
        return $this->belongsToMany(Zone::class, 'coupons_zones', 'coupon_id', 'zone_id');
    } public function sellers(){
        return $this->belongsToMany(Seller::class, 'coupons_sellers', 'coupon_id', 'seller_id');
    }
}
