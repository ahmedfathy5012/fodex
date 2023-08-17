<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class MajorclassificationcontentSeller extends Model
{
     protected $table = 'majorclassificationcontent_sellers';
    public $timestamps = true;
    protected $guarded = [];
    public function seller(){
        return $this->belongsTo(Seller::class,'seller_id');
    }
}
