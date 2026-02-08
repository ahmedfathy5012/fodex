<?php

namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Driver;
use App\Models\Order;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\OrderResource;
use App\traits\ApiTrait;
use App\Events\DriverMoved;
use App\traits\generaltrait;
class OrderController extends Controller
{
    use ApiTrait,generaltrait;
    public function current_orders(){
        try{
              $user = auth()->user();
              if($user->is_company == 1){
            $orders = Order::where([["company_id","=",$user->id],["status","=",2]])->orderBy("id","desc")->get();

              }else{
             $orders = Order::where([["driver_id","=",$user->id],["status","=",2]])->orderBy("id","desc")->get();
              }
             $msg = "الطلبات الجاريه";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    } public function last_orders(){
        try{
              $user = auth()->user();
               if($user->is_company == 1){
              $orders = Order::where([["company_id","=",$user->id],["status","=",3]])->orderBy("id","desc")->get();

               }else{
             $orders = Order::where([["driver_id","=",$user->id],["status","=",3]])->orderBy("id","desc")->get();
               }
             $msg = "الطلبات الاخيره";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function new_orders(){
        try{
              $user = auth()->user();
               if($user->is_company == 1){
              $orders = Order::where([["company_id","=",$user->id],["status","=",2],["delivery_status","=",0]])->orderBy("id","desc")->get();

               }else{
             $orders = Order::where([["driver_id","=",$user->id],["status","=",2],["delivery_status","=",0]])->orderBy("id","desc")->get();
               }
             $msg = "الطلبات الجديده";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function change_delivery_status(Request $request){
          try{
              $user = auth()->user();
       
        $rules = [
            "order_id" => "required|numeric",
           // "delivery_status" => "required|numeric"
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         $order = Order::where("id",$request->order_id)->first();
         $order2 = Order::where("id",$request->order_id)->where("driver_id",$user->id)->first();

         if(!$order){
             $msg = 'لا يوجد طلب بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }elseif(!$order2){
             $msg = 'لا تمتلك الصلاحيات اللازمه   لتغيير حاله هذا الطلب ';
               return $this->errorResponse($msg,403);
         }else{
             if($order->delivery_status   < 4){
         $data["delivery_status"] = $order->delivery_status + 1;
          $order->update($data);
          if($order->delivery_status == 1){
              $order->driver_accept = now();
              $order->save();
          } if($order->delivery_status == 2){
              $order->driver_waiting_order = now();
               $order->save();
          } if($order->delivery_status == 3){
              $order->driver_pickup = now();
               $order->save();
          } if($order->delivery_status == 4){
              $order->driver_waiting_client = now();
               $order->save();
          }
             }else if($order->delivery_status == 4){
                 
                 
      $data["delivery_status"] = 5;
        $data["status"] = 3;
         $order->delivery_time = now();
          $order->save();
          $order->update($data);
             }else{
                 
      $data["delivery_status"] = 5;
        $data["status"] = 3;
          $order->update($data);
          $order->delivery_time = now();
          $order->save();
             }
             $msg = "تم تغيير الحاله بنجاح ";
             return $this->dataResponse($msg,new OrderResource($order),200);
         }
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
    public function order_delivered_status(Request $request){
          try{
              $user = auth()->user();
       
        $rules = [
            "order_id" => "required|numeric"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         $order = Order::where("id",$request->order_id)->first();
         $order2 = Order::where("id",$request->order_id)->where("driver_id",$user->id)->first();

         if(!$order){
             $msg = 'لا يوجد طلب بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }elseif(!$order2){
             $msg = 'لا تمتلك الصلاحيات اللازمه   لتغيير حاله هذا الطلب ';
               return $this->errorResponse($msg,403);
         }else{
         $data["status"] = 3;
          $order2->update($data);
             $msg = "تم توصيل الطلب  بنجاح ";
             return $this->successResponse($msg,200);
         }
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function driver_home(){
         ///try{
              $driver = auth()->user();
              
               if($driver->is_company == 1){
                       $neworders = Order::where([["company_id","=",$driver->id],["delivery_status","=",0]])->orderBy("id","desc")->get();
                $del_orders = Order::where("company_id","=",$driver->id)->whereNotIn("delivery_status",[0,5])->orderBy("id","desc")->get();
               }else{
               $neworders = Order::where([["driver_id","=",$driver->id],["delivery_status","=",0]])->orderBy("id","desc")->get();
                $del_orders = Order::where("driver_id","=",$driver->id)->whereNotIn("delivery_status",[0,5])->orderBy("id","desc")->get();
               }
              $msg = "driver_home";
           //   dd(OrderResource::collection($del_orders));
              return response()->json([
                  'status' => true,
                  'message' => $msg,
             //     'data' => [
                      'new_orders' => OrderResource::collection($neworders),
                      'orders_under_delivery' =>  OrderResource::collection($del_orders)//]
                  ]);
    //      }catch (\Exception $ex) {
    //      return $this->returnException( $ex->getMessage(),500);
    //   }
    }
}