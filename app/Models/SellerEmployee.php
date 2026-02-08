<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Seller;
class SellerEmployee extends Authenticatable
{

    protected $table = 'sellers_employees';
    public $timestamps = true;
    protected $guarded = [];
      public function holidays()
    {
        return $this->belongsToMany(Day::class, 'selleremployees_days','selleremployee_id','day_id');
    }
    public function seller(){
        return $this->belongsTo(Seller::class,"seller_id");
    }
}