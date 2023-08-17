<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sellermessage extends Model 
{

    protected $table = 'sellermessages';
    public $timestamps = true;
    protected $fillable = array('message', 'seller_id');
    protected $visible = array('message', 'seller_id');

}