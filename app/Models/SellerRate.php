<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;
class SellerRate extends Model
{
        protected $table = 'sellers_rates';
    public $timestamps = true;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale('ar');
           $time = Carbon::parse($value);
           return $time->diffForHumans();
    }
}