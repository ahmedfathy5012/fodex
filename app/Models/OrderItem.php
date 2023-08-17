<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItemExtra;
use App\Models\Size;
use App\Models\Item;
use App\Models\Order;
class OrderItem extends Model
{
        protected $guarded = [];
  protected $table = "order_items";
  public function extrass(){
   return $this->hasMany(OrderItemExtra::class,'order_item_id');   
  }
  public function extras()
    {
        return $this->belongsToMany(\App\Models\Extradetail::class, 'order_items_extra','order_item_id','extra_id');
    }public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
