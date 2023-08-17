<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone;
class SellerZone extends Model
{
   
    protected $table = 'seller_zones';
    public $timestamps = true;
    protected $guarded = [];
    public function zone(){
        return $this->belongsTo(Zone::class,"zone_id");
    }
}
