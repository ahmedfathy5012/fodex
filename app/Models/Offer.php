<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone;
class Offer extends Model
{
  protected $table = 'offers';
    public $timestamps = true;
    protected $guarded = [];
 public function zones()
    {
        return $this->belongsToMany(Zone::class, 'offer_zones','offer_id','zone_id');
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
