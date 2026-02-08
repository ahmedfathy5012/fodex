<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
class SellerExtra extends Model 
{

    protected $table = 'seller_extras';
    public $timestamps = true;
    protected $guarded = "seller_extras";

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

}