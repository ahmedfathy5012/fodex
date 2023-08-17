<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartExtra;
use App\Models\Item;
class Cart extends Model
{
    protected $table = "carts";
    protected $guarded = [];
    public function extras(){
        return $this->hasMany(CartExtra::class,'cart_id');
    }  public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
