<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MajorClassificationZone extends Model
{
  
    protected $table = 'majorsclassifications_zones';
    public $timestamps = true;
    protected $fillable = array('id','majorclassification_id', 'zone_id');
    protected $visible = array('id','majorclassification_id', 'zone_id');
  
}
