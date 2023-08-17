<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
   
    protected $table = 'coins';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');
}
