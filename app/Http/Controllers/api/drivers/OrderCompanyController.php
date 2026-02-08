<?php
namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\traits\ApiTrait;

use App\Http\Resources\CaptainResource;


use App\Http\Resources\OrderResource;

use App\Models\Driver;
use App\Models\Order;

use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;
use App\Services\SendNotification;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




class OrderCompanyController extends Controller
{
    use ApiTrait;
    public function choose_driver_order(Request $request){
                   try { 
                
        $rules = [
             'order_id' => 'required',
             "driver_id" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
          $driver = Driver::whereId($request->driver_id)->first();
        $order = Order::whereId($request->order_id)->first();
        if(!$driver){
            $msg ="لا يوجد كابتن بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
          if(!$order){
            $msg ="لا يوجد طلب بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
          $order->driver_id = $request->driver_id; 
              $order->insert_order_driver = now(); 
             $order->save();
             $notification = new Notification;
             $notification->driver_id = $request->driver_id;
             $notification->title = "اشعار جديد";
             $notification->text = "لديك طلب جديد برقم " . $order->id;
             $notification->save();
             
          $noti_class = new SendNotification;
          $noti_class->send($driver->device_token,$notification->title,$notification->text);
                 $msg =  "تم ادراج الطلب للسائق";
        
         return $this->dataResponse($msg, new OrderResource($order),200);
                   } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }
        public function call_seller_for_order(Request $request){
                   try { 
                
        $rules = [
             'order_id' => 'required',
             "seller_status" =>"required"
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
        $order = Order::whereId($request->order_id)->first();
       
          if(!$order){
            $msg ="لا يوجد طلب بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
          $order->seller_status = $request->seller_status; 
              $order->seller_notes = $request->seller_notes;
             $order->save();
             
                 $msg =  "تم  ابلاغ المطعم بنجاح";
        
         return $this->dataResponse($msg, new OrderResource($order),200);
                   } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }
public function order_available_captains(Request $request){
                   try { 
                
        $rules = [
             'order_id' => 'required'
             ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
        $order = Order::whereId($request->order_id)->first();
       
          if(!$order){
            $msg ="لا يوجد طلب بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
          $drivers = Driver::where("driver_id",auth()->id())->where("available",1)->get();
        
             $msg =  "my_captains   ";
        
         return $this->dataResponse($msg, CaptainResource::collection($drivers),200);
                   } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }
}