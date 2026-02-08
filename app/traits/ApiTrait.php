<?php
namespace App\traits;
use Illuminate\Support\Facades\File;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Zone;
use App\Models\CartExtra;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use App\Models\Extradetail;
use App\Models\Size;
use App\Models\OrderItemExtra;
Trait ApiTrait
{
    public function errorResponse($msg,$code)
    {
        return response()->json([
            'status' => false,
            'message' => $msg
        ],$code);
    }public function successResponse($msg,$code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $msg
        ],$code);
    } public function dataResponse($msg,$data,$code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $msg,
            'data' => $data
        ],$code);
      }public function getvalidationErrors($validator,$code = 422)
       {
        return $this->errorResponse($validator->errors()->first(),$code);
       }public function returnException($message,$code )
       {
        return $this->errorResponse($message,$code);
       }public function is_in_polygon($longitude_x, $latitude_y,$polygon)
{
  $i = $j = $c = 0;
  $points_polygon = count($polygon)-1;
  for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
    if ( (($polygon[$i]->lat  >  $latitude_y != ($polygon[$j]->lat > $latitude_y)) &&
     ($longitude_x < ($polygon[$j]->lon - $polygon[$i]->lon) * ($latitude_y - $polygon[$i]->lat) / ($polygon[$j]->lat - $polygon[$i]->lat) + $polygon[$i]->lon) ) )
       $c = !$c;
  }
  return $c;
}public function check_coupon_value($coupon_id,$major_id){
           try{
              $user = auth()->user();
        $user_id = auth()->id();
        // $rules = [
        //     "coupon_id" => "required",
        //     "major_id" => "required",
        // ];
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return $this->getvalidationErrors($validator);
        //  } 
         $coupon = Coupon::where("name",$coupon_id)->first();
         if(!$coupon){
             $msg = 'لا يوجد كوبون بهذا  الاسم';
               return 0;
         }
           $count_use = count(Order::where([["user_id","=",$user_id],["coupon_id","=",$coupon_id]])->get());
             $cart = Cart::where("user_id",$user_id)->where("major_id",$major_id)->get();
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
                      //     $msg = 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون';
                               return 0;
                          }else if($count_use >= $coupon->usage_number){
                       $msg = 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون';
                        return 0;
                          }else{
                            
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
                  $msg = 'تم التحقق من الكوبون بنجاج';
                   return 0;
                 
                          }
                       // }
                        }else{
                            // $msg = "عفوا عنوانك ليس من ضمن منطقه الكوبون";
                         return 0;
                        }
                    }else{
                        // $msg = "من فضلك اختر عنوان لك";
                         return 0;
                    }
                  
                } elseif(in_array($seller_id,$coupon->sellers->pluck("id")->toArray())){
                          if($finalprice < $coupon->minmum_price){
            //$msg = 'عفوا هذا الكوبون لا يطبق على الطلب لان سعر الطلب اقل من اقل سعر للكوبون';
             return 0;
                          }else if($count_use >= $coupon->usage_number){
        //    $msg = 'عفوا لقد وصلت للحد الاقصى من استخدام الكوبون';
             return 0;
                          }else{
                                 if($coupon->delivery_fee == 1){
                                       return $coupon_price;
                               }
                              if($coupon->percentage == 0){
                                  $coupon_price = $coupon->value;
                              }else{
                                     $coupon_price = ($coupon->value /100) * $finalprice;
                              }
              //    $msg = 'تم التحقق من الكوبون بنجاج';
                   return $coupon_price;
                 
                          }
                       // } 
                }
                else{
            $msg = 'عفوا لا يمكنك استخدام الكوبون'; 
             return 0;
                }
            }else{
            $msg = 'عفوا انتهى مده الكوبون'; 
               return 0;
            }
            }else{
                 $msg = 'لا يوجد  لديك شئ فى السله   ';
                return 0;
               
            }
           }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function inside($lat, $lon,$fenceArea) {
$x = $lat; $y = $lon;

$inside = false;
for ($i = 0, $j = count($fenceArea) - 1; $i <  count($fenceArea); $j = $i++) {
    $xi = $fenceArea[$i]['lat']; $yi = $fenceArea[$i]['lon'];
    $xj = $fenceArea[$j]['lat']; $yj = $fenceArea[$j]['lon'];

    $intersect = (($yi > $y) != ($yj > $y))
        && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
    if ($intersect) $inside = !$inside;
}

return $inside;
}

          public function res_distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}
        public function setting_email(){
            return "ehabtalaat5552@gmail.com";
        }
}