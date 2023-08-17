<?php

namespace App\Http\Controllers\api\selleremployees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\SellerEmployee;
use App\Models\Order;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\OrderResource;
use App\traits\ApiTrait;
use App\Models\Notification;
use App\User;
use App\Models\Driver;
use App\Models\Seller;
class OrderController extends Controller
{
    use ApiTrait;
    public function current_orders(){
        try{
              $user = auth()->user();
              
             $orders = Order::where([["seller_id","=",$user->seller_id],['cancel','=','0']])->whereIn("status",[1,2])->orderBy("id","desc")->get();
             $msg = "الطلبات الجاريه";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    } public function last_orders(){
        try{
              $user = auth()->user();
             $orders = Order::where([["seller_id","=",$user->seller_id],["status","=",3]])->Orwhere([["seller_id","=",$user->seller_id],['cancel','=','1']])->orderBy("id","desc")->get();
             $msg = "الطلبات الاخيره";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function new_orders(){
        try{
              $user = auth()->user();
             $orders = Order::where([["seller_id","=",$user->seller_id],["status","=",1]])->orderBy("id","desc")->get();
             $msg = "الطلبات الجديده";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    } public function order_under_excuting(){
        try{
              $user = auth()->user();
              
             $orders = Order::where([["seller_id","=",$user->seller_id],['cancel','=','0']])->whereIn("status",[1,2])->orderBy("id","desc")->get();
             $msg = "الطلبات تحت التحضير";
             return $this->dataResponse($msg, OrderResource::collection($orders),200);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }public function change_order_status(Request $request){
          try{
              $user = auth()->user();
       
        $rules = [
            "order_id" => "required|numeric",
            "status" => "required|numeric"
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         $order = Order::where("id",$request->order_id)->first();
         $order2 = Order::where("id",$request->order_id)->where("seller_id",$user->seller_id)->first();
        $user1 = User::where("id",$order->user_id)->first();
       // $driver_order = Driver::where("id",$order->driver_id)->first();
        $seller = Seller::where("id",$order->seller_id)->first();
          $driver = Driver::where("id",$order->driver_id)->first();
         if(!$order){
             $msg = 'لا يوجد طلب بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }elseif(!$order2){
             $msg = 'لا تمتلك الصلاحيات اللازمه   لتغيير حاله هذا الطلب ';
               return $this->errorResponse($msg,403);
         }else{
         $data["seller_status"] = $request->status;
         if($request->status == 1){
              $order->seller_accept = now();
               $order->save();
         }
         if($request->status == 2){
               $order->preparation_time = now();
               $order->save();
              $data["status"] = 2;
                      $not = new Notification;
        $not->user_id = $user1->id;
        $not->title ="اشعار جديد";
         $not->text = "تم تحضير الطلب رقم ". $order->id ;
        $not->save();
         $to = $user1->device_token;
        $data2 = [
            "to" =>$to,
            //  "notification" =>[
            //         "title" => $not->title,
            //         'body' => $not->text,
            //     ],
            "data" =>[
                    "title" => $not->title,
                    'body' => $not->text,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    'type' => 'public'
                ], 
        ];
        $dataString = json_encode($data2);
        $headers = [
            'Authorization: key=AAAAVXr9TPk:APA91bHZNUKiOeJhtedm_gz7oZcug24feavhrfwKjsHgrDWDgnc53FSr_p8vAFUxt--RuFWSoHxW1ouaxjnmQEZMiw-MZDty5UkTgQMiNPM1PeGdigHoKBhJp-210VVsMTOHepZBcjEK',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      $result=curl_exec($ch);
      if($driver){
      $title ="اشعار جديد";
        $text =  "تم  تحضير طلب برقم ".$order->id." من مطعم ".$seller->name;
          $to1 = $driver->device_token;
        
        $data1 = [
            "to" =>$to1,
            //  "notification" =>[
            //         "title" => $title,
            //         'body' => $text,
            //     ],
            "data" =>[
                    "title" => $title,
                    'body' => $text,
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    'type' => 'public'
                ], 
        ];
        $dataString = json_encode($data1);
        $headers = [
            'Authorization: key=AAAAVXr9TPk:APA91bHZNUKiOeJhtedm_gz7oZcug24feavhrfwKjsHgrDWDgnc53FSr_p8vAFUxt--RuFWSoHxW1ouaxjnmQEZMiw-MZDty5UkTgQMiNPM1PeGdigHoKBhJp-210VVsMTOHepZBcjEK',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
      $result=curl_exec($ch);
      }
         }
          $order2->update($data);
             $msg = "تم تغيير الحاله بنجاح ";
             return $this->successResponse($msg,200);
         }
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    } public function seller_home(){
        try{
              $user = auth()->user();
              
             $orders = Order::where([["seller_id","=",$user->seller_id],['cancel','=','0']])->whereIn("status",[1,2])
             ->where("seller_status",'!=',0)->where("seller_status",'!=',3)
             ->orderBy("id","desc")->get();
              $neworders = Order::where([["seller_id","=",$user->seller_id],["status","=",1]])
              ->where("seller_status",0)->orderBy("id","desc")->get();
             $msg = "seller_home";
             return response()->json(['status'=> true,"message" =>$msg,
             'data' => [
                 "new_orders" =>OrderResource::collection($neworders),
                 'orders_under_excuting' => OrderResource::collection($orders)]]);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
 
}