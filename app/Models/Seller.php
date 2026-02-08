<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\City;
use App\Models\Tag;
use App\Models\Payment;
use App\Models\State;
use App\Models\SellerZones;
use App\Models\Address;
use App\Models\Zone;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Major;
use App\Models\Item;
use App\Models\Category;
use App\Models\Sellerimage;
use App\Models\Order;
use App\Models\AllCollection;
use App\Models\SellerRate;
use App\Models\SellerEmployee;
use Carbon\Carbon;
use App\Models\Workschedule;
use App\Scopes\CentralRestaurantVisibilityScope;

class Seller extends Authenticatable
{

    protected static function booted(): void
    {
        static::addGlobalScope(new CentralRestaurantVisibilityScope);
    }

    protected $table = 'sellers';
    public $timestamps = true;
    protected $fillable = array('id', 'name', 'phone', 'mobile', 'prepare_time', 'description', 'major_id', 'device_token', 'verify_code', 'api_token', 'password', 'wallet_amount', 'block', 'availability', 'not_available_reason', 'block_reason', 'close', 'distance_range', 'commission', 'is_central');
    protected $visible = array('id', 'name', 'phone', 'mobile', 'prepare_time', 'description', 'major_id', 'device_token', 'verify_code', 'api_token', 'password', 'wallet_amount', 'block', 'availability', 'not_available_reason', 'block_reason', 'close', 'distance_range', 'commission', 'is_central');
    protected $appends = ["image_link", "currency", "rate"];
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'seller_category', 'seller_id', 'category_id')->withPivot('order_number');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'sellers_tags', 'seller_id', 'tag_id');
    }
    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'payments_sellers', 'seller_id', 'payment_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'seller_id');
    }


    // TODO : HASHEM
    public function images()
    {
        return $this->hasMany(Sellerimage::class, 'seller_id');
    }
    // TODO : HASHEM
    public function image()
    {
        return $this->hasOne(Sellerimage::class, 'seller_id');
    }
    public function getImageLinkAttribute()
    {
        return $this->logo ? asset('uploads/' . $this->logo) : '';
    }

    public function sellerMessages()
    {
        return $this->hasMany('Sellermessage', 'seller_id');
    }

    public function workschedules()
    {
        return $this->hasMany(Workschedule::class, 'seller_id');
    }

    public function social()
    {
        return $this->hasOne('Social', 'seller_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'seller_id');
    }

    public function contracts()
    {
        return $this->hasMany('Sellercontract', 'seller_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }
    public function acceptorders()
    {
        return $this->hasMany(Order::class, 'seller_id')->where("status", 1);
    }
    public function done_orders()
    {
        return $this->hasMany(Order::class, 'seller_id')->where("status", 3);
    }
    public function allcollection()
    {
        return $this->hasMany(AllCollection::class, 'seller_id');
    }
    public function sellerzones()
    {
        return $this->hasMany(SellerZone::class, "seller_id");
    }
    public function zones_of_seller()
    {
        return $this->belongsToMany(Zone::class, "seller_zones", "seller_id", "zone_id");
    }
    public function getCurrencyAttribute()
    {
        return $this->address->country->coin->title ?? "";
    }
    public function rates()
    {
        return $this->hasMany(SellerRate::class, "seller_id");
    }
    public function getRateAttribute()
    {

        $average_rate = count($this->rates) != 0 ? array_sum($this->rates->pluck("rate")->toArray()) / count($this->rates) : 0;
        return $average_rate;
    }
    public function getOpenAttribute()
    {
        $open = 0;
        $day_id = (Carbon::now()->dayOfWeek) + 1;
        $time_now = Carbon::now()->format('H:i:s');
        $day = $this->workschedules()->where("day_id", $day_id)->first();
        if ($day) {
            if ($time_now >= $day->work_from && $time_now < $day->work_to) {
                $open = 1;
            }
        }
        return $open;
    }
    public function employees()
    {
        return $this->hasMany(SellerEmployee::class, 'seller_id');
    }
    public function mycategories()
    {
        return $this->belongsToMany(Category::class, 'seller_category', 'seller_id', 'category_id')->withPivot('order_number')->whereHas("items", function ($query) {
            return $query->whereIn("id", $this->items->pluck("id")->toArray());
        });
    }
}
