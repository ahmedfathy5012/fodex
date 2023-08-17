<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\User;
use App\Models\Address;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CouponResource;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Zone;
use App\Models\CartExtra;
use App\Models\Order;
use App\Models\OrderItem;
use App\traits\ApiTrait;
use App\Models\Extradetail;
use App\Models\Size;
use App\Models\OrderItemExtra;
use App\Http\Resources\latlonResource;
class CouponController extends Controller
{
     use ApiTrait;
    public function online_voucher(){
        $coupons = Coupon::with("sellers")->get();
        return response()->json([
            'status' => true,
            'message' => 'الكوبونات',
            'data' => CouponResource::collection($coupons)
            ]);
    }public function check_coupon(Request $request){
         //  try{
              $user = auth()->user();
        $user_id = auth()->id();
        $rules = [
            "coupon_id" => "required",
            "major_id" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         $coupon = Coupon::where("name",$request->coupon_id)->first();
         if(!$coupon){
             $msg = 'لا يوجد كوبون بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
           $count_use = count(Order::where([["user_id","=",$user_id],["coupon_id","=",$request->coupon_id]])->get());
             $cart = Cart::where("user_id",$user_id)->where("major_id",$request->major_id)->get();
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
                 $item_price =$price + $item_price;
            }
               $seller_id = Item::whereIn("id",$item_ids)->first()->seller_id;
            $discount = array_sum($items->pluck("discount")->toArray());
          //  $item_price = array_sum($items->pluck("price")->toArray());
            $extra_price = array_sum(Extradetail::whereIn("id",$extra_ids)->get()->pluck("extra_price")->toArray());
            $finalprice = $item_price + $extra_price;
                     $now = Carbon::now()->format("Y-m-d");
            if($coupon->date_form <= $now && $coupon->date_to >= $now){
                
                if($coupon->cities && count($coupon->cities) > 0){
                    if($user->address){
                        $in_address = 0;
                        foreach($coupon->cities as $city){
                             $lat = $user->address->lat;
                             $lon =  $user->address->lon;
                     $in_address =  $this->is_in_polygon($lon,$lat,latlonResource::collection($city->areas));
                        }
                         if($in_address == 1){
                     if($finalprice < $coupon->minmum_price){
                           $msg = 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون';
                               return $this->errorResponse($msg,422);
                          }else if($count_use >= $coupon->usage_number){
                       $msg = 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون';
                        return $this->errorResponse($msg,422);
                          }else{
                              if($coupon->delivery_fee == 1){
                                   $msg = 'تم التحقق من الكوبون بنجاج ولديك توصيل مجانى';
                   return $this->successResponse($msg,0,200);
                              }
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                  $msg = 'تم التحقق من الكوبون بنجاج';
                   return $this->successResponse($msg,$coupon_price,200);
                 
                          }
                       // }
                        }else{
                             $msg = "عفوا عنوانك ليس من ضمن منطقه الكوبون";
                         return $this->errorResponse($msg,422);
                        }
                    }else{
                        $msg = "من فضلك اختر عنوان لك";
                         return $this->errorResponse($msg,422);
                    }
                  
                } elseif(in_array($seller_id,$coupon->sellers->pluck("id")->toArray())){
                          if($finalprice < $coupon->minmum_price){
            $msg = 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون';
             return $this->errorResponse($msg,422);
                          }else if($count_use >= $coupon->usage_number){
            $msg = 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون';
             return $this->errorResponse($msg,422);
                          }else{
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                  $msg = 'تم التحقق من الكوبون بنجاج';
                   return $this->errorResponse($msg,$coupon_price,422);
                 
                          }
                       // } 
                }
                else{
            $msg = 'عفوا لا يمكنك استخدام الكوبون'; 
              return $this->errorResponse($msg,422);
                }
            }else{
            $msg = 'عفوا انتهى مده الكوبون'; 
              return $this->errorResponse($msg,422);
            }
            }else{
                 $msg = 'لا يوجد  لديك شئ فى السله   ';
               return $this->errorResponse($msg,404);
               
            }
    //       }catch (\Exception $ex) {
    //      return $this->returnException( $ex->getMessage(),500);
    //   }
    }public function checklat(){
        $lat = 30.026050687916648;
        $lon =  31.384396011718742;
        $zone = Zone::where("id",5)->first();
       return  $this->is_in_polygon($lon,$lat,latlonResource::collection($zone->areas));
        
    }
}