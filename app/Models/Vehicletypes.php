<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicletypes extends Model 
{

    protected $table = 'vehicletypes';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');

}