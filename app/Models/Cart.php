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

    public function getPriceAttribute()
{
    return $this->item->price ?? 0;
}

public function getPriceAfterDiscountAttribute()
{

    // // لو مفيش خصم أو الخصم خلص، يرجع السعر الأصلي
    // if (!$this->discount || now()->lt($this->discount_from) || now()->gt($this->discount_to)) {
    //     return $this->price;
    // }

    // // حساب السعر بعد الخصم (هنا discount كنسبة %)
    // return $this->price - ($this->price * ($this->discount / 100));
    return $this->item->price_after_discount ?? $this->item->price ?? 0;
}

public function getDiscountAttribute()
{
    return $this->item->discount ?? 0;
}

}
