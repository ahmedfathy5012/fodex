<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class MajorsclassificationOffer extends Model
{
  
    protected $table = 'majorsclassifications_offers';
    public $timestamps = true;
   protected $guarded = [];

     public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
