<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Extradetail;
use App\Http\Resources\SellerResource;
use App\Models\Cart;
class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_id = auth()->id();
        $carts =  Cart::where('major_id',$request->major_id)->where('user_id',$user_id)->get();
        if($this->item->discount > 0){
            $discount = $this->item->discount * $this->count_number;
        }else{
            $discount = 0;
        }
        $size = \App\Models\Size::where("id",$this->size_id)->first();
     if($this->size_id){
         $price = (intval($size->price) * $this->count_number);
         $price_after_discount = (intval($size->price) * $this->count_number) - $discount;
     }else{
           $price = (intval($this->item->price) * $this->count_number);
         $price_after_discount = (intval($this->item->price) * $this->count_number) - $discount;
     }
     
     
           $extra_price = 0;
           foreach($carts as $cart){
           foreach($cart->extras as $extra){
               if(is_array($this->item_extras_details)){
             if(in_array($extra->extra_id,$this->item_extras_details->pluck("id")->toArray())){
         $extr =  Extradetail::where('id',$extra->extra_id)->first();
              $extra_price += $extr->extra_price * $extra->count_number;

             }
               }
           }
            
           }
            
           
        
           
        return [
            //  'id' => intval($this->id),
            'id' => intval($this->item_id),
            'cart_item_id' => intval($this->id),
            'title' => $this->item ? $this->item->title : '',
            'image' => $this->item->imageone ? [asset('uploads/'.$this->item->imageone->image)]: [],
            // 'price' => $size ? (intval($size->price) * $this->count_number)  :0,
            // 'price_after_discount' => $size ? (intval($size->price) * $this->count_number) - $discount : 0,
             'price' => $price + $extra_price,
            'price_after_discount' => $price_after_discount + $extra_price,
            'discount' => $discount,
            // 'item_id' => intval($this->item_id),
            'major_id' => intval($this->major_id),
             'size' => $this->size ? $this->size->title : '',
             "size_id" => intval($this->size_id),
             //'extra' => $this->extras->pluck('extra_id'),
             'extra_names' => Extradetail::whereIn('id',$this->extras->pluck('extra_id'))->get()->pluck('title'),
             'count' => intval($this->count_number),
             'currency' => $this->item->currency ?? ""
            //  'seller' => $this->item->seller ? new SellerResource($this->item->seller) : [],
            ];
    }
}
