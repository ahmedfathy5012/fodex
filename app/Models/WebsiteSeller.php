<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class WebsiteSeller extends Model
{
   
    protected $table = 'website_sellers';
    public $timestamps = true;
    protected $fillable = array('id','seller_id');
    protected $visible = array('id','seller_id');
     public function sellers(){
        return $this->belongsToMany(Seller::class, 'sellers_tags', 'id', 'seller_id');
     }
}
