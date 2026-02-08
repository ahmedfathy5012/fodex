<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class Sellerimage extends Model 
{

    protected $table = 'sellerimages';
    public $timestamps = true;
    protected $fillable = array('id','image', 'seller_id');
    protected $visible = array('id','image', 'seller_id');

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

}