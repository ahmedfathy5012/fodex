<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class MajorclassificationContent extends Model
{
        protected $table = 'majorsclassifications_content';
    public $timestamps = true;
    protected $guarded = [];
     public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'majorclassificationcontent_sellers','majorclassificationcontent_id','seller_id')->withPivot('order_number');
    }
}
