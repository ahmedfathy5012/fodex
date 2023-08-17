<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Box;
use App\Models\Driver;
class BoxTake extends Model
{
   protected $table = 'box_takes';
    public $timestamps = true;
    public function driver(){
        return $this->belongsTo(Driver::class,"driver_id");}
        public function box(){
        return $this->belongsTo(Box::class,"box_id");}
    
}
