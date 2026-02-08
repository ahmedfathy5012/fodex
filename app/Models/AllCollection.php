<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use Carbon\Carbon;
class AllCollection extends Model 
{

    protected $table = 'all_collections';
    public $timestamps = true;
   protected $guarded = [];
 public function seller(){
     return $this->belongsTo(Seller::class,'seller_id');
  }  
//public function getCreatedAtAttribute($value)
//     {
//         Carbon::setLocale('ar');
//           $time = Carbon::parse($value);
//           return $time->diffForHumans();
//     } 
protected $appends = ['date_time'];
public function getDateTimeAttribute()
    {
                Carbon::setLocale('ar');
        $time = Carbon::parse($this->attributes['created_at']);
          return $time->diffForHumans();

    }
}