<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\CartExtra;
use App\Models\Order;
use App\Models\OrderItem;
// use App\Models\OrderItemExtra;
use Validator;
use App\Models\Coupon;
use App\Models\Seller;
use App\Models\Extradetail;
use App\Models\Size;
use App\Models\OrderItemExtra;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\OrdertemResource;
use App\Http\Resources\OrderResource;
use Carbon\Carbon;
use App\Models\DashboardNotification;
use App\Models\Notification;
use App\Events\GetOrder;
use App\traits\ApiTrait;
use App\Models\Zone;
use App\Models\AppStatus;
use App\Models\DeliveryArea;
use App\Models\SellerZone;
use App\Models\Driver;

class OrderController extends Controller
{
    use ApiTrait;
 /*   public function check_coupon(Request $request){
        $user_id = auth()->id();
        $user = auth()->user();
        $cart = Cart::where("user_id",$user_id)->where("major_id",$request->major_id)->get();
         //$seller_id = Cart::where("user_id",$user_id)->where("major_id",$request->major_id)->first()->seller_id;
        $coupon = Coupon::where("name",$request->coupon_id)->first();
        $count_use = count(Order::where("user_id",$user_id)->where("coupon_id",$request->coupon_id)->get());
        if(count($cart) > 0){
            $item_ids = $cart->pluck('item_id')->toArray();
            $cart_ids = $cart->pluck('id')->toArray();
            $extra_ids = CartExtra::whereIn("cart_id",$cart_ids)->get()->pluck("extra_id")->toArray();
            $items = Item::whereIn("id",$item_ids)->get();
              $item_price = 0;
            foreach($cart as $c){
                 $it = Item::where("id",$c->item_id)->first();
                  $size = Size::where("id",$c->size_id)->first();
                 $price = ($size->price - $it->discount) * $c->count_number;
                 $item_price .=$price;
            }
               $seller_id = Item::whereIn("id",$item_ids)->first()->seller_id;
            $discount = array_sum($items->pluck("discount")->toArray());
          //  $item_price = array_sum($items->pluck("price")->toArray());
            $extra_price = array_sum(Extradetail::whereIn("id",$extra_ids)->get()->pluck("extra_price")->toArray());
            $finalprice = $item_price + $extra_price;
       //     dd($finalprice);
        }
        if(!$coupon){
            return response()->json(['status' => false,
            'message' => 'لايوجد كوبون بهذا الاسم']);
        } if(count($cart) == 0){
            return response()->json(['status' => false,
            'message' => 'لايوجد   لديك شىء فى السله']);
        }if($coupon){
            $now = Carbon::now()->format("Y-m-d");
            if($coupon->date_form <= $now && $coupon->date_to >= $now){
                if($user->address){
                   // if($coupon->zones){
                        if(in_array($user->address->zone_id,$coupon->zones->pluck("id")->toArray())){
                             if($finalprice < $coupon->minmum_price){
                                return response()->json(['status' => false,
            'message' => 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون']); 
                          }else if($count_use >= $coupon->usage_number){
                              return response()->json(['status' => false,
            'message' => 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون']); 
                          }else{
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                                    return response()->json(['status' => true,
                  'message' => 'تم التحقق من الكوبون بنجاج',
                  'discount' => $coupon_price]); 
                          }
                      }
                   // }elseif($coupon->cities){
                         else if(in_array($user->address->city_id,$coupon->cities->pluck("id")->toArray())){
                             if($finalprice < $coupon->minmum_price){
                                return response()->json(['status' => false,
            'message' => 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون']); 
                          }else if($count_use >= $coupon->usage_number){
                              return response()->json(['status' => false,
            'message' => 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون']); 
                          }else{
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                                    return response()->json(['status' => true,
                  'message' => 'تم التحقق من الكوبون بنجاج',
                  'discount' => $coupon_price]); 
                          }
                        }
                   // }elseif($coupon->states){
                         elseif(in_array($user->address->state_id,$coupon->cities->pluck("id")->toArray())){
                             if($finalprice < $coupon->minmum_price){
                                return response()->json(['status' => false,
            'message' => 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون']); 
                          }else if($count_use >= $coupon->usage_number){
                              return response()->json(['status' => false,
            'message' => 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون']); 
                          }else{
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                                    return response()->json(['status' => true,
                  'message' => 'تم التحقق من الكوبون بنجاج',
                  'discount' => $coupon_price]); 
                          }
                        }
                   // }
                    //elseif($coupon->coutries){
                         elseif(in_array($user->address->country_id,$coupon->countries->pluck("id")->toArray())){
                             if($finalprice < $coupon->minmum_price){
                                return response()->json(['status' => false,
            'message' => 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون']); 
                          }else if($count_use >= $coupon->usage_number){
                              return response()->json(['status' => false,
            'message' => 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون']); 
                          }else{
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                                    return response()->json(['status' => true,
                  'message' => 'تم التحقق من الكوبون بنجاج',
                  'discount' => $coupon_price]); 
                          }
                        }
                //    }
               /// }elseif($coupon->sellers){
                  
                } elseif(in_array($seller_id,$coupon->sellers->pluck("id")->toArray())){
                          if($finalprice < $coupon->minmum_price){
                                return response()->json(['status' => false,
            'message' => 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون']); 
                          }else if($count_use >= $coupon->usage_number){
                              return response()->json(['status' => false,
            'message' => 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون']); 
                          }else{
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                                return response()->json(['status' => true,
                  'message' => 'تم التحقق من الكوبون بنجاج',
                  'discount' => $coupon_price]); 
                          }
                       // } 
                }
                else{
                    return response()->json(['status' => false,
            'message' => 'عفوا لا يمكنك استخدام الكوبون']);      
                }
            }else{
              return response()->json(['status' => false,
            'message' => 'عفوا انتهى مده الكوبون']);   
            }
        }
    }*/
    public function send_order(Request $request){
         $user_id = auth()->id();
        $user = auth()->user();
        $app_status  = AppStatus::firstOrNew();
       if($app_status->status == 0){
           $new_msg = $app_status->message;
            return response()->json(['status' => false,
            'message' => $new_msg]);
        }
        if($user->address){
       
        $cart = Cart::where("user_id",$user_id)->where("major_id",$request->major_id)->get();
         //$seller_id = Cart::where("user_id",$user_id)->where("major_id",$request->major_id)->first()->seller_id;
        if(count($cart) > 0){
            $item_ids = $cart->pluck('item_id')->toArray();
            $cart_ids = $cart->pluck('id')->toArray();
            $extra_ids = CartExtra::whereIn("cart_id",$cart_ids)->get()->pluck("extra_id")->toArray();
            $items = Item::whereIn("id",$item_ids)->get();
             $item_price = 0;
            foreach($cart as $c){
                 $it = Item::where("id",$c->item_id)->first();
                 $size = Size::where("id",$c->size_id)->first();
                  if($size){
         $price = ($size->price - $it->discount) * $c->count_number;
                  }else{
           $price = ($it->price - $it->discount) * $c->count_number;
     }
                
                 $item_price +=$price;
            }
            
               $seller_id = Item::whereIn("id",$item_ids)->first()->seller_id;
               $seller = Seller::where("id",$seller_id)->first();
               $zones= Zone::get();
               $delivery_fee = null;
               // START HASHEM
            //    if(count($seller->zones_of_seller) > 0){
            //    foreach($seller->zones_of_seller as $seller_zone){
            //           if($this->inside($user->address->lat,$user->address->lon,$seller_zone->areas)){
            //               break;
            //    }
            //       $msg ="عفوا هذا المطعم لا يمكنه التوصيل لهذا لهذه المنطقه";
            //  return $this->errorResponse($msg,422); 
              
            //   }
            //    }
            //      else{ $msg ="عفوا هذا المطعم لا يمكنه التوصيل لهذا لهذه المنطقه";
            //  return $this->errorResponse($msg,422);
            //      }
               // END HASHEM
        //         foreach($zones as $zone){
        //       if($this->inside($user->address->lat,$user->address->lon,$zone->areas)){
        //          $distance = $this->res_distance($user->address->lat,$user->address->lon,$seller->address->lat,$seller->address->lon,'K');
        //        if($price_dels = $zone->prices()->where("from_distance","<",$distance)->where("to_distance",">",$distance)->first()){
        //            $delivery_fee = $price_dels->price;
        //            break;
        //        }
        //           $msg ="عفوا لايوجد توصيل لهذا المسافه";
        //      return $this->errorResponse($msg,422); 
              
        //       }
        //   }
        // TODO: HASHEM
        $delivery_fee=1;
          if($delivery_fee == null){
                        $msg ="عفوا لايوجد توصيل لهذا المنطقه";
             return $this->errorResponse($msg,422); 
          }
            $delivery_areas = DeliveryArea::get();
            $extra_del_price = 0;
            // START HASHEM
            //  foreach($delivery_areas as $delivery_area){
            //   if($this->inside($user->address->lat,$user->address->lon,$delivery_area->areas)){
            //     $extra_del_price = $delivery_area->price;
            //     break;
            //    }
            //   }
            // END HASHEM
          
            //     if(!in_array($user->address->zone_id,$seller->sellerzones->pluck("zone_id")->toArray())){
            //       $msg ="عفوا منطقتك ليست من ضمن مناطق توصيل هذا المطعم";
            //  return $this->errorResponse($msg,422);      
            //     }
            //     $sellerzone = SellerZone::where([["zone_id","=",$user->address->zone_id],["seller_id","=",$seller_id]])->first();
             $delivery_fee = $delivery_fee + $extra_del_price;
            //     $delivery_fee = $sellerzone->delivery_money;
         //   $discount = array_sum($items->pluck("discount")->toArray());
           // $item_price = array_sum($items->pluck("price")->toArray());
            $extra_price = array_sum(Extradetail::whereIn("id",$extra_ids)->get()->pluck("extra_price")->toArray());
            $finalprice = $item_price + $extra_price;
         
             $order = new Order;
             $order->lat = $user->address->lat;
             $order->lon = $user->address->lon;
             $order->address = $user->address->address;
             $order->building_number = $user->address->building_number;
              $order->building_type = $user->address->building_type;
               $order->floor_number = $user->address->floor_number;
                $order->flat_number = $user->address->flat_number;
                $order->notes = $request->notes;
                //check coupon
                if($request->coupon_id){
               $discount = $this->check_coupon_value($request->coupon_id,$request->major_id);
               if($discount != 0){
                    $coupon = Coupon::where("name",$coupon_id)->first();
                    $order->coupon_id = $coupon->id;
                  if($coupon->delivery_fee == 1){
                      $delivery_fee = 0;
                  }
               }
                }else{
                    $discount = 0;
                }
                if($request->payment_method_id){
                $order->payment_method_id = $request->payment_method_id;
                }else{
                   $order->payment_method_id = 1; 
                }
             $order->phone = $user->address->phone;
            // 
             $order->discount = $request->discount;
              $order->user_id = $user_id;
              $order->seller_id = $seller_id;
               $order->price = $finalprice + $delivery_fee;
               $order->order_commission = $seller->commission;
                $order->delivery_fee = $delivery_fee;
               if($user->address){
                 $order->country_id = $user->address->country_id; 
                  $order->state_id = $user->address->state_id; 
                   $order->city_id = $user->address->city_id; 
                    $order->zone_id = $user->address->zone_id;
               }
            
                 $order->priceafterdiscount = ($finalprice + $delivery_fee) - $discount;
                // dd(intval($seller->min_order) <= $finalprice);
              if($seller->open == 0){
    
                      $msg ="عفوا المطعم مغلق الان";
             return $this->errorResponse($msg,422);  
              }if($seller->availability == 0){
                      $msg ="عفوا المطعم غير متاح الان";
             return $this->errorResponse($msg,422);  
              }
             if($seller->min_order > $finalprice){
                 $msg ="عفوا سعر الطلب يجب ان يتعدي اقل سعر للطلب من هذا المطعم";
             return $this->errorResponse($msg,422);  
             }
             
             $order->save();
             
         $company = Driver::where("is_company",1)->whereHas("zones",function($q) use ($order){
  
                    return $q->whereIn("zones.id",[$order->zone_id]);
                })->first();
                
                $zone = Zone::where("id",$order->zone_id)->first();
                
            if($company){
                if($zone && $zone->automatic == 1){
                $order->update([
                    "company_id" => $company->id ?? null
                    ]);
                }
            }
             $notification = new DashboardNotification;
             $notification->time = $now = Carbon::now()->format('g:i A');
             $notification->date = $now = Carbon::now()->format('Y-m-d');
             $notification->order_id = $order->id;
             $msg = "لديك طلب جديد من ".auth()->user()->name .' ' ."الى مطعم ".$seller->name;
            
             $notification->message = $msg ;
             $notification->save();
              event(new GetOrder( $notification->message, $notification->time));
            
             foreach($cart as $c){
                 $ordit= new OrderItem;
                 $ordit->item_id  = $c->item_id;
                 $ordit->order_id  = $order->id;
                 
                 $ordit->size_id  = $c->size_id;
                 $ordit->quantity  = $c->count_number;
                    $it = Item::where("id",$c->item_id)->first();
                 $size = Size::where("id",$c->size_id)->first();
        if($size){
         $price1 = ($size->price - $it->discount) * $c->count_number;
                  }else{
           $price1 = ($it->price - $it->discount) * $c->count_number;
     }
                 $ordit->price = $price;
                 $ordit->save();
                 if($c->extras){
                     foreach($c->extras as $ex){
                      $ord_it_ex  = new  OrderItemExtra;
                      $ord_it_ex->order_item_id= $ordit->id;
                      $ord_it_ex->price = Extradetail::where("id",$ex->extra_id)->first()->extra_price;
                      $ord_it_ex->extra_id = $ex->extra_id;
                      $ord_it_ex->save();
                     }
                 }
             }
            Cart::where("user_id",$user_id)->where("major_id",$request->major_id)->delete();
            
            $details = [
   'title' => 'لديك طلب جديد من فودكس',
   'body' => "  تحية طيبة ...
   يوجد طلب  جديد من قبل
 
   ( ".$order->user->name.")

   يرجى تاكيد الطلب أو الرفض والتواصل مع العميل في أسرع وقت ممكن ..",
   'id' => $order->id
];

\Mail::to($this->setting_email())->send(new \App\Mail\SendOrder($details));

               return response()->json(['status' => true,'message' => 'order done'
          ,'data' => new OrderResource($order)
        //   )[
        //       'id' => $user_id,
        //       'major_id' => $request->major_id,
        //       'items'=> OrdertemResource::collection($order->items),
        //       'order_price' => [
        //           'total' => $order->price,
        //           'total_after_discount' => $order->priceafterdiscount,
        //           'discount' => doubleval($order->discount)]
        //       ]
               ]);
        }else{
            return response()->json(['status' => false,
            'message' => 'لايوجد   لديك شىء فى السله']); 
        }
        }else{
            $msg = "عفوا لا يوجد لديك عنوان";
             return $this->errorResponse($msg,422);
        }
    }
    public function cancel_order(Request $request){
          $validator = Validator::make($request->all(),[
            'order_id' => "required"],
            [
            'required' => 'حقل الطلب مطلوب'    ]);
            if($validator->passes()){
       $order = Order::where("id",$request->order_id)->first();
        if($order){
              $order1 = Order::where([["id",'=',$request->order_id],["user_id","=",auth()->id()]])->first();
            if($order1){
       $order->cancel = 1;
       $order->save();
           $msg = "تم الغاء الطلب بنجاح";
            return response()->json(['status' => true,'message' => $msg],200);
            }else{
                 $msg = "لا يمكنك حذف  طلب ليس لك";
            return response()->json(['status' => false,'message' => $msg],403);
            }
        }else{
            $msg = "لا يوجد طلب بهذا الاسم";
            return response()->json(['status' => false,'message' => $msg],404);
        }                
            }else{
                return response()->json(['status' => false,'message' => $validator->errors()->first()],422);
            }
    }
}