<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class HomecontentZone extends Model
{
  
    protected $table = 'homecontent_zones';
    public $timestamps = true;
    protected $fillable = array('id','homecontent_id', 'zone_id');
    protected $visible = array('id','homecontent_id', 'zone_id');
}
