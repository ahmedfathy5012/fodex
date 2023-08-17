<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class HomecontentSeller extends Model
{
  
    protected $table = 'homecontent_sellers';
    public $timestamps = true;
    protected $fillable = array('id','homecontent_id', 'seller_id');
    protected $visible = array('id','homecontent_id', 'seller_id');
    public function seller(){
        return $this->belongsTo(Seller::class,'seller_id');
    }
}
