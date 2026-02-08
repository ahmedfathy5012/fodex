<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerTag extends Model
{
   
    protected $table = 'sellers_tags';
    public $timestamps = true;
    protected $fillable = array('id','tag_id','seller_id');
    protected $visible = array('id','tag_id','seller_id');
}
