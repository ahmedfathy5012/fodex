<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefusedReason extends Model
{
      protected $table = 'refused_reasons';
    public $timestamps = true;
    protected $fillable = array('id','text');
    protected $visible = array('id','text');
}
