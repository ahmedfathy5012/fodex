<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Major;
use App\Models\Zone;
class MajorClassification extends Model
{
   
    protected $table = 'majors_classifications';
    public $timestamps = true;
    protected $fillable = array('id','title', 'image','major_id');
    protected $visible = array('id','title', 'image','major_id');
    
    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'majorsclassifications_sellers','majorclassification_id','seller_id')
        ->withPivot('order_number');
    }public function major(){
        return $this->belongsTo(Major::class,'major_id');
    }public function zones()
    {
        return $this->belongsToMany(Zone::class, 'majorsclassifications_zones','majorclassification_id','zone_id');
    }
}
