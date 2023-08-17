<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class MajorClassificationSeller extends Model
{
  
    protected $table = 'majorsclassifications_sellers';
    public $timestamps = true;
    protected $fillable = array('id','majorclassification_id', 'seller_id');
    protected $visible = array('id','majorclassification_id', 'seller_id');
    public function seller(){
        return $this->belongsTo(Seller::class,'seller_id');
    }
}
