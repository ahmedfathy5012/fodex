<?php

namespace App\Http\Controllers\CompanyDashboard;;

use Illuminate\Http\Request;
use App\User;
use App\Models\Seller;
use App\Models\Driver;
use App\Models\Order;
use App\DataTables\companydashboard\OrderDataTable;
use App\traits\ApiTrait;
use App\Models\Notification;
use App\Services\SendNotification;
use App\Http\Controllers\Controller;
use Validator;

class OrderController extends Controller
{
    
    use ApiTrait;
    protected $view = 'companydashboard.orders.';
     protected $route = 'company_captions.';
   public function index(OrderDataTable $dataTable)
    {

        return $dataTable->render($this->view.'index');
    
  }
    public function choose_your_driver(Request $request){
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
        
         return $this->successResponse($msg,200);
                   } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }


}
