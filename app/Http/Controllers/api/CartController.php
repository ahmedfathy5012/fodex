<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Size;
use App\Models\Item;
use App\Models\CartExtra;
use App\Http\Resources\SellerResource;
use App\Models\Extradetail;
use App\Http\Resources\CartItemResource;
use App\traits\ApiTrait;
use App\Models\Seller;
use App\Models\SellerZone;
use App\Models\DeliveryArea;
use App\Models\Zone;

class CartController extends Controller
{
    use ApiTrait;
    public function addcart($id,$request,$user_id){
          $item = Item::where('id',$id)->first();
            $cart = new Cart;
        $cart->item_id = $item->id;
       $cart->major_id = $item->major_id;
         $cart->user_id = $user_id;
        if($request->size_id){
             if(Size::where('id',$request->size_id)->first()){
                $cart->size_id = $request->size_id;
        }else{
               return response()->json(['status' => false,'message'=> 'عفوا لايوجد حجم بهذا الاسم']);
        
        }
        }else{
            $size =$item->sizes()->where('size_default',1)->first();
            if($size){
             $cart->size_id = $size->id;
            }
            else{
                //   return response()->json(['status' => false,'message'=> 'عفوا لايوجد   حجم افتراضى من فضلك اختر حجم']);
            }
        }
        $cart->count_number = $request->count;
        
        $cart->save();
       
       if($request->extra_ids){
            foreach($request->extra_ids as $extra_id){
                if(Extradetail::where('id',$extra_id)->first()){
            $cartextra = new CartExtra;
            $cartextra->cart_id = $cart->id;
            $cartextra->extra_id = $extra_id;
            $cartextra->save();
                }
        }
       }else{
          $extra = Extradetail::whereIn('id',$item->extrasdetails())->where('default_new',1)->first();
          if($extra){
             $cartextra = new CartExtra;
            $cartextra->cart_id = $cart->id;
            $cartextra->extra_id = $extra->id;
            $cartextra->save(); 
          }
       }
        return $cart;
        
       
    }
    public function add_to_cart(Request $request){
      
     $user_id = auth()->id();
        $user = auth()->user();
       
        if($user->address){
      
        $item = Item::where('id',$request->item_id)->first();
        if(!$item){
        return response()->json(['status' => false,'message'=> 'عفوا لايوجد منتج بهذا الاسم']);
            
        }
         $my_carts =  Cart::where('major_id',$item->major_id)->where('user_id',auth()->id())->get();
          $my_cart =  Cart::where('major_id',$item->major_id)->where('user_id',auth()->id())->first();
               // $delivery_fee = 0;
                   $out_of_range = 0;
               $seller = Seller::where("id",$item->seller_id)->first();
            //     if(in_array($user->address->zone_id,$seller->sellerzones->pluck("zone_id")->toArray())){
            //         $sellerzone = SellerZone::where([["zone_id","=",$user->address->zone_id],["seller_id","=",$seller->id]])->first();
             
            //   if($sellerzone){
            //     $delivery_fee = $sellerzone->delivery_money ?? 0;
            //     $out_of_range = 0;
            //  }
                  
            //     }
               
                 $zones= Zone::get();
               $delivery_fee = null;
                foreach($zones as $zone){
              if($this->inside($user->address->lat,$user->address->lon,$zone->areas)){
                 $distance = $this->res_distance($user->address->lat,$user->address->lon,$seller->address->lat,$seller->address->lon,'K');
               if($price_dels = $zone->prices()->where("from_distance","<",$distance)->where("to_distance",">",$distance)->first()){
                   $delivery_fee = $price_dels->price;
                   break;
               }
                    $out_of_range = 1;
              
              }
          }
          if($delivery_fee == null){
                          $out_of_range = 1;
          }
           $delivery_areas = DeliveryArea::get();
            $extra_del_price = 0;
             foreach($delivery_areas as $delivery_area){
              if($this->inside($user->address->lat,$user->address->lon,$delivery_area->areas)){
                $extra_del_price = $delivery_area->price;
                break;
               }
              }
          if($my_cart){
            
             $seller_id =  $my_cart->item->seller->id ?? "";
             if($item->seller_id == $seller_id){
                 
             }else{
                 $msg = "عفوا لايمكنك الطلب من مطعمين فى نفس الوقت";
                  return response()->json(['status' => false,'message' => $msg]);  
             }
          }
          
       
        $user_id = auth()->id();
        $size =$item->sizes()->where('size_default',1)->first();
        if($request->size_id){
       $cart= Cart::where([['item_id','=',$request->item_id],['size_id', '=',$request->size_id],['user_id',$user_id]])->first();
     
       if($cart){
           if($request->extra_ids){
             if(array_diff($cart->extras->pluck('extra_id')->toArray(), $request->extra_ids) == []){
           $cart->count_number +=$request->count;
           $cart->save();
           foreach($request->extra_ids as $extra){
               $CartExtra = CartExtra::where([['extra_id','=',$extra],['cart_id','=',$cart->id]])->first();
             if($CartExtra){
               $CartExtra->count_number +=1;
               $CartExtra->save();
               }
           }
        }
           }else{
         $cart = $this->addcart($request->item_id,$request,auth()->id());
        }  
        }else{
           $cart = $this->addcart($request->item_id,$request,auth()->id());
        }  
        }else{
            $size_id  = $size->id ?? ""; 
             $cart= Cart::where([['item_id','=',$request->item_id],['size_id', '=',$size_id],['user_id',$user_id]])->first();
             if($cart){
           if($request->extra_ids){
             if(array_diff($cart->extras->pluck('extra_id')->toArray(), $request->extra_ids) == []){
           $cart->count_number +=$request->count;
           $cart->save();
           foreach($request->extra_ids as $extra){
               $CartExtra = CartExtra::where([['extra_id','=',$extra],['cart_id','=',$cart->id]])->first();
             if($CartExtra){
               $CartExtra->count_number +=1;
               $CartExtra->save();
               }
           }
        }else{
              $cart = $this->addcart($request->item_id,$request,auth()->id());
        }  
           }
        } else{
            $cart = $this->addcart($request->item_id,$request,auth()->id());
        }  
        }
      

     
       // start response
           $majorId = intval($item->major_id);
          $carts =  Cart::where('major_id',$majorId)->where('user_id',$user_id)->get();
          $total = array_sum(collect(CartItemResource::collection($carts))->pluck('price')->toArray());
          $total_after_discount = array_sum(collect(CartItemResource::collection($carts))->pluck('price_after_discount')->toArray());
          $discount = array_sum(collect(CartItemResource::collection($carts))->pluck('discount')->toArray());
          
          $extra_price = 0;
         $ex_ids =  $cart->extras;
       ///  $extras =  Extradetail::whereIn('id',$ex_ids)->get();
        //  foreach($ex_ids as $ex_id){
        //       $extr =  Extradetail::where('id',$ex_id->extra_id)->first();
        //       $extra_price += $extr->extra_price * $ex_id->count_number;
        //  }
        return response()->json(['status' => true,'message' => 'تم اضافة العنصر بنجاح'
          ,'data' => [
              'id' => intval($item->id),
              'new_added_cart_id' => $item ? $item->id : null,
              'major_id' => intval($cart->major_id),
              'out_of_range' =>$out_of_range,
              'seller'=>  new SellerResource($item->seller),
               'items'=> CartItemResource::collection($carts),
              'currency' => $item->seller->currency ?? "",

               'order_price' => [
                   'price' => $total + $extra_price,
                   'price_after_discount' => $total_after_discount + $extra_price,
                   'delivery_fee' => doubleval($delivery_fee) + doubleval($extra_del_price),
                   'total' => doubleval($total) + doubleval($delivery_fee) + doubleval($extra_price) + doubleval($extra_del_price),
                   'total_after_discount' => $total_after_discount + $delivery_fee + $extra_price + $extra_del_price,
                   'discount' => $discount
                   ]
               ]
               ]);
        }else{
            $msg = "عفوا لا يوجد لديك عنوان";
             return $this->errorResponse($msg,422);
        }
    }public function remove_cart_item(Request $request){

         if($request->cart_id){
            $cart =  Cart::where('id',$request->cart_id)->first();
         }else if($request->product_id){
            $cart =  Cart::where('id',$request->item_id)->first();
         }
          
          if(!$cart){
             $msg = 'لا يوجد عنصر كارت بهذا  الاسم';
               return $this->errorResponse($msg,404);
          }
          $cart->delete();
          $user_id = auth()->id();
           $user = auth()->user();
          $carts =  Cart::where('major_id', $cart->major_id)->where('user_id',$user_id)->get();
             $newcart =  Cart::where('major_id', $cart->major_id)->where('user_id',$user_id)->first();
          $total = array_sum(collect(CartItemResource::collection($carts))->pluck('price')->toArray());
          $total_after_discount = array_sum(collect(CartItemResource::collection($carts))->pluck('price_after_discount')->toArray());
          $discount = array_sum(collect(CartItemResource::collection($carts))->pluck('discount')->toArray());
          
           $seller_id =$newcart->item->seller->id ?? "";
            $seller = Seller::where("id",$seller_id)->first();
            $delivery_fee = 0;
                   $out_of_range = 1;
            if($seller){
                $zone_id = $user->address->zone_id ?? "";
                if(in_array($zone_id,$seller->sellerzones->pluck("zone_id")->toArray())){
                    $sellerzone = SellerZone::where([["zone_id","=",$zone_id],["seller_id","=",$seller->id]])->first();
             
                if($sellerzone){
                $delivery_fee = $sellerzone->delivery_money ?? 0;
                $out_of_range = 0;
             }
                  
                }
            }
        return response()->json(['status' => true,'message' => 'تم حذف العنصر بنجاح'
          ,'data' => [
               'id' => $user_id,
               'major_id' => $newcart ? intval($newcart->major_id) : null,
               'out_of_range' =>$out_of_range,
                'seller'=> $newcart ?  new SellerResource($newcart->item->seller) : null,
               'items'=> CartItemResource::collection($carts),
            'currency' => $item->seller->currency ?? "",

               'order_price' => [
                  'price' => $total,
                   'price_after_discount' => $total_after_discount,
                   'delivery_fee' => intval($delivery_fee),
                   'total' => $total + $delivery_fee,
                   'total_after_discount' => $total_after_discount + $delivery_fee,
                   'discount' => $discount
                   ]
               ]
               ]);
    }public function edit_cart_item_count(Request $request){
           if($request->cart_id){
            $cart =  Cart::where('id',$request->cart_id)->first();
           }else if($request->product_id){
            $cart =  Cart::where('id',$request->item_id)->first();
           }
           if(!$cart){
             $msg = 'لا يوجد عنصر كارت بهذا  الاسم';
               return $this->errorResponse($msg,404);
          }
          $cart->count_number = $request->count;
           $cart->save();
           //
           $user_id = auth()->id();
           $user = auth()->user();
          $carts =  Cart::where('major_id',$cart->major_id)->where('user_id',$user_id)->get();
          $total = array_sum(collect(CartItemResource::collection($carts))->pluck('price')->toArray());
          $total_after_discount = array_sum(collect(CartItemResource::collection($carts))->pluck('price_after_discount')->toArray());
          $discount = array_sum(collect(CartItemResource::collection($carts))->pluck('discount')->toArray());
          $seller_id =$cart->item->seller->id ?? "";
            $seller = Seller::where("id",$seller_id)->first();
        //      $delivery_fee = 0;
                   $out_of_range = 1;
            // if($seller){
            //     $zone_id = $user->address->zone_id ?? "";
            //     if(in_array($zone_id,$seller->sellerzones->pluck("zone_id")->toArray())){
            //         $sellerzone = SellerZone::where([["zone_id","=",$zone_id],["seller_id","=",$seller->id]])->first();
             
            //   if($sellerzone){
            //     $delivery_fee = $sellerzone->delivery_money ?? 0;
            //     $out_of_range = 0;
            //  }
                  
            //     }
            // }
             
             
                 $zones= Zone::get();
               $delivery_fee = null;
                foreach($zones as $zone){
              if($this->inside($user->address->lat,$user->address->lon,$zone->areas)){
                 $distance = $this->res_distance($user->address->lat,$user->address->lon,$seller->address->lat,$seller->address->lon,'K');
               if($price_dels = $zone->prices()->where("from_distance","<",$distance)->where("to_distance",">",$distance)->first()){
                   $delivery_fee = $price_dels->price;
                   break;
               }
                    $out_of_range = 1;
              
              }
          }
          if($delivery_fee == null){
                          $out_of_range = 1;
          }
           $delivery_areas = DeliveryArea::get();
            $extra_del_price = 0;
             foreach($delivery_areas as $delivery_area){
              if($this->inside($user->address->lat,$user->address->lon,$delivery_area->areas)){
                $extra_del_price = $delivery_area->price;
                break;
               }
              }  
        return response()->json(['status' => true,'message' => 'تم تعديل العنصر بنجاح'
          ,'data' => [
              'id' => $user_id,
              'major_id' => $cart ? intval($cart->major_id) : null,
             'out_of_range' =>$out_of_range,
               'seller'=>  new SellerResource($cart->item->seller) ?? null,
               'items'=> CartItemResource::collection($carts),
               'currency' => $item->seller->currency ?? "",
               'order_price' => [
                    'price' => $total,
                   'price_after_discount' => $total_after_discount,
                   'delivery_fee' => intval($delivery_fee) +$extra_del_price,
                   'total' => $total + $delivery_fee +$extra_del_price,
                   'total_after_discount' => $total_after_discount + $delivery_fee + $extra_del_price,
                   'discount' => $discount
                   ]
               ]
               ]);
    }
    
    
    public function my_cart(Request $request){


          $user_id = auth()->id();
          $user = auth()->user();
          
          $carts =  Cart::where('major_id',$request->major_id)->where('user_id',$user_id)->get();

          $cart =  Cart::where('major_id',$request->major_id)->where('user_id',$user_id)->first();
          $total = array_sum(collect(CartItemResource::collection($carts))->pluck('price')->toArray());
          $total_after_discount = array_sum(collect(CartItemResource::collection($carts))->pluck('price_after_discount')->toArray());
          $discount = array_sum(collect(CartItemResource::collection($carts))->pluck('discount')->toArray());
          
           $seller_id =$cart->item->seller->id ?? "";
            $seller = Seller::where("id",$seller_id)->first();
             // $delivery_fee = 0;
                  $out_of_range = 1;
            // if($seller){
            //     $zone_id = $user->address->zone_id ?? "";
            //     if(in_array($zone_id,$seller->sellerzones->pluck("zone_id")->toArray())){
            //         $sellerzone = SellerZone::where([["zone_id","=",$zone_id],["seller_id","=",$seller->id]])->first();
            //  if($sellerzone){
            //     $delivery_fee = $sellerzone->delivery_money ?? 0;
            //     $out_of_range = 0;
            //  }
                  
            //     }
            // }
            
            
               $extra_price = 0;
         $ex_ids =  $cart->extras ?? [];
       ///  $extras =  Extradetail::whereIn('id',$ex_ids)->get();
        //  foreach($ex_ids as $ex_id){
        //       $extr =  Extradetail::where('id',$ex_id->extra_id)->first();
        //       $extra_price += $extr->extra_price * $ex_id->count_number;
        //  }
         
         
               $zones= Zone::get();
               $delivery_fee = null;
               if($cart){
                foreach($zones as $zone){
              if($this->inside($user->address->lat,$user->address->lon,$zone->areas)){
                 $distance = $this->res_distance($user->address->lat,$user->address->lon,$seller->address->lat,$seller->address->lon,'K');
               if($price_dels = $zone->prices()->where("from_distance","<",$distance)->where("to_distance",">",$distance)->first()){
                   $delivery_fee = $price_dels->price;
                   break;
               }
                    $out_of_range = 1;
              
              }
          }
               }
          if($delivery_fee == null){
                          $out_of_range = 1;
          }
           $delivery_areas = DeliveryArea::get();
            $extra_del_price = 0;
             foreach($delivery_areas as $delivery_area){
              if($this->inside($user->address->lat,$user->address->lon,$delivery_area->areas)){
                $extra_del_price = $delivery_area->price;
                break;
               }
              }  
          return response()->json(['status' => true,'message' => 'your cart'
          ,'data' => [
               'id' => $user_id,
                 'major_id' => $cart ? intval($cart->major_id) : null,
                 'out_of_range' =>$out_of_range,
               'seller'=> $cart ?  new SellerResource($cart->item->seller) : null,
               'items'=> CartItemResource::collection($carts),
              'currency' =>$cart->item->seller->currency ?? "",

               'order_price' => [
                   'price' => $total + $extra_price,
                   'price_after_discount' => $total_after_discount + $extra_price,
                   'delivery_fee' => doubleval($delivery_fee) + doubleval($extra_del_price),
                   'total' => $total + $delivery_fee + $extra_price + $extra_del_price,
                   'total_after_discount' => $total_after_discount + $delivery_fee + $extra_price + $extra_del_price,
                   'discount' => $discount
                   ]
               ]
               ]);
    }
}
