<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Zone;

class HomeContent extends Model
{
   
    protected $table = 'homecontent';
    public $timestamps = true;
    protected $fillable = array('id','title', 'image');
    protected $visible = array('id','title', 'image');
    
    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'homecontent_sellers','homecontent_id','seller_id')->withPivot('order_number');
    }public function zones()
    {
        return $this->belongsToMany(Zone::class, 'homecontent_zones','homecontent_id','zone_id');
    }
}
