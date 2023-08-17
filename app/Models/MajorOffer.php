<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MajorOffer extends Model
{
  protected $table = 'majors_offers';
    public $timestamps = true;
      protected $guarded = [];

     public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
