<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
class Address extends Model 
{

    protected $table = 'addresses';
    public $timestamps = true;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('Address', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->hasOne('State', 'state_id');
    }

    public function city()
    {
        return $this->hasOne('City', 'city_id');
    }

    public function employee()
    {
        return $this->belongsTo('Employee', 'employee_id');
    }

    public function seller()
    {
        return $this->belongsTo('Seller', 'seller_id');
    }

}