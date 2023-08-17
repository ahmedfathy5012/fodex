<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
class CheckoutDriver extends Model
{
   protected $table = 'checkout_drivers';
    public $timestamps = true;
    public function driver(){
        return $this->belongsTo(Driver::class,"driver_id");}
       
}
