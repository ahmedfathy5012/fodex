<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\CartExtra;
use App\Models\Order;
use App\Models\OrderItem;
use Validator;
use App\Models\Address;
use App\Models\Extradetail;
use App\Models\Size;
use App\Models\OrderItemExtra;
use App\Http\Resources\AddressResource;
use Carbon\Carbon;
use App\traits\ApiTrait;
use App\Models\Zone;
class AddressController extends Controller
{
    use ApiTrait;
    public function add_address(Request $request){
        try{
            $zone_id = "";
              $user = auth()->user();
              foreach(Zone::get() as $zone){
     // $status = $this->is_in_polygon($request->lon,$request->lat,$zone->areas);
      $status = $this->inside(doubleval($request->lat),doubleval($request->lon),$zone->areas);
                   if($status){
                       $zone_id = $zone->id;
                   }
              }
             
            
        $rules = [
            "address" => "required",
            "flat_number" => "numeric",
            "floor_number" => "numeric",
            "building_number" => "numeric",
            "phone" => "required",
            'lat' => "required",
            'lon' => "required"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
          $addresses = Address::where("user_id",$user->id);
         $addresses->update([
                 "active" => 0
                 ]);
         $data["user_id"] = $user->id;
         $data["flat_number"] = $request->flat_number;
         $data["address"] = $request->address;
         $data["floor_number"] = $request->floor_number;
         $data["building_number"] = $request->building_number;
         $data["building_type"] = $request->building_type;
         $data["phone"] = $request->phone;
          $data["lat"] = $request->lat;
          $data["lon"] = $request->lon;
          $address = Address::create($data);
          $zone = Zone::where("id",$zone_id)->first();
          if($zone){
              $address->zone_id = $zone->id;
              $address->city_id = $zone->city_id;
              $address->state_id = $zone->state_id;
              $address->country_id = $zone->country_id;
              $address->save();
          }
          $data["active"] = 1;
          $address->update($data);
             $msg = "تم اضافه  العنوان بنجاح";
             return $this->dataResponse($msg,new AddressResource($address),200);
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function active_address(Request $request){
          try{
              $user = auth()->user();
       
        $rules = [
            "address_id" => "required|numeric"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         $address = Address::where("id",$request->address_id)->first();
         $address2 = Address::where("id",$request->address_id)->where("user_id",$user->id)->first();
         $addresses = Address::where("user_id",$user->id);
         if(!$address){
             $msg = 'لا يوجد عنوان بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }elseif(!$address2){
             $msg = 'لا تمتلك الصلاحيات اللازمه لاستخدام هذا العنوان';
               return $this->errorResponse($msg,403);
         }else{
             $addresses->update([
                 "active" => 0
                 ]);
         $data["active"] = 1;
          $address2->update($data);
             $msg = "تم   جعل العنوان مفعل  بنجاح";
             return $this->dataResponse($msg,new AddressResource($address),200);
         }
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function your_addresses(){
          try{
              $user = auth()->user();
             $addresses = Address::where("user_id",$user->id)->get();
             $msg = "كل عناوينك";
             return $this->dataResponse($msg,AddressResource::collection($addresses),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function your_active_addresses(){
          try{
              $user = auth()->user();
             $address = Address::where([["user_id","=",$user->id],["active","=",1]])->orderBy("id","desc")->first();
             $msg = "العنوان المفعل";
             return $this->dataResponse($msg,new AddressResource($address),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}