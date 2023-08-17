<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class Tag extends Model
{
   
    protected $table = 'tags';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');
     public function sellers(){
        return $this->belongsToMany(Seller::class, 'sellers_tags', 'tag_id', 'seller_id');
     }
}
