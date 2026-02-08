<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSeller extends Model
{
   
    protected $table = 'payments_sellers';
    public $timestamps = true;
    protected $fillable = array('id','payment_id','seller_id');
    protected $visible = array('id','payment_id','seller_id');
}
