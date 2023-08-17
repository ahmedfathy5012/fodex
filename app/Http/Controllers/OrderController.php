<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\User;
use App\Models\Zone;
use App\Models\Seller;
use App\Models\Driver;
use App\DataTables\OrderDataTable;
use App\DataTables\OrderItemDataTable;
use App\DataTables\DailyOrderDataTable;
use App\Models\Order;
use App\Models\OrderItemExtra;
use App\Models\OrderItem;
use App\DataTables\SellerOrderDataTable;
use App\DataTables\DriverordersDataTable;
use App\DataTables\DriverCurrentOrderDataTable;
use App\traits\generaltrait;
use App\Models\Notification;
use App\Services\SendNotification;

class OrderController extends Controller
{
    use generaltrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(OrderDataTable $dataTable)
    {
   $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.orders.orders',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $dataTable->id = $id;
        //   return $dataTable->render('admindashboard.orders.ordersitems');
    }
    public function showorders(OrderItemDataTable $dataTable,$id)
    {
        $dataTable->id = $id;
        $order = Order::where('id',$id)->first();
          return $dataTable->render('admindashboard.orders.showorder',['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('id',$id)->first();
        $order->delete();
        return response()->json(['status' => true]);
    }public function orderstatus(Request $request){
      
        $order = Order::where('id',$request->id)->first();
            $user = User::where("id",$order->user_id)->first();
        $order->status = $request->status;
        $order->employee_id =auth()->id();
        if($request->status == 1){
             
            $order->status = 1;
           //   $order->driver_id = $request->driver_id;  
              $order->accepted_at = now();
        $order->save();
        $seller = Seller::Where("id",$order->seller_id)->first();
      $users = $seller->employees;
          $msg = "لديك طلب جديد برقم " . $order->id;
                foreach($users as $user1){

         $to = $user1->device_token;
    $noti_class = new SendNotification;
          $noti_class->send($to,"اشعار جديد",$msg);
                        
                    }
          $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->title ="اشعار جديد";
        $notification->text = "تم قبول الطلب رقم ". $order->id . ' بنجاح'; 
        $notification->save();
         $to =$user->device_token;
           $noti_class = new SendNotification;
          $noti_class->send($to,$notification->title,$notification->text);
          
         return response()->json(['status' => true,'type'=> "accept"]);
        }elseif($request->status == 2){
              $order->cancel = 1;
          $order->refusedreason_id = $request->refusedreason_id;  
        $order->save();
          $not = new Notification;
        $not->user_id = $user->id;
        $not->title ="اشعار جديد";
          $not->text = "تم رفض الطلب رقم ". $order->id . ' بنجاح';
        $not->save();
         $to = $user->device_token;
         
         $noti_class = new SendNotification;
         
          $noti_class->send($to,$notification->title,$notification->text);
          
         return response()->json(['status' => true,'type'=> "refused"]);
        }
    }public function editprice(Request $request){
        $order= Order::where('id',$request->id)->first();
        $order->discount = $request->discount;
        $order->price = $request->price;
        $order->priceafterdiscount = $order->price - $order->discount;
        $order->save();
        return response()->json(['status' => true]);
    }  public function sellerorders(SellerOrderDataTable $dataTable,$id)
    {
       $dataTable->id = $id;
        return $dataTable->render('admindashboard.sellerorders.index');
  }public function driverorders(DriverordersDataTable $dataTable,$id)
    {
       $dataTable->id = $id;
     $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.driverorders.index',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
  }
  //driver current order
  public function driver_cuurent_orders(DriverCurrentOrderDataTable $dataTable,$id)
    {
       $dataTable->id = $id;
        return $dataTable->render('admindashboard.driverorders.current_orders');
  }
  
  public function deleteitemorder($id){
      $orderitem = OrderItem::where('id',$id)->first();
      $order = Order::where('id',$orderitem->order_id)->first();
       $orderextra = array_sum(OrderItemExtra::where('order_item_id',$orderitem->id)->get()->pluck('price')->toArray());
       $price = $orderextra + $orderitem->price;
       $order->price -= $price;
       $order->priceafterdiscount -=$price;
       $order->save();
       $orderitem->delete();
       OrderItemExtra::where('order_item_id',$orderitem->id)->delete();
       return response()->json(['status' => true,'order_id' => $order->id]);
  }public function changequantity(Request $request){
      //dd($request->all());
      $orderitem = OrderItem::where('id',$request->id)->first();
      $price = $orderitem->price / $orderitem->quantity;
      $finalprice = $price * $request->quantity;
      $order = Order::where('id',$orderitem->order_id)->first();
       $order->price -= $orderitem->price;
       $order->priceafterdiscount -=$orderitem->price;
     
       $order->save();
         $orderitem->quantity = $request->quantity;
         $orderitem->save();
         $order->price += $finalprice;
       $order->priceafterdiscount +=$finalprice;
       $order->save();
       return response()->json(['status' => true,'order_id' => $order->id]);
  }public function choosedriver(Request $request){
           $driver = Driver::whereId($request->driver_id)->first();
             $order = Order::where('id',$request->id)->first();
           //  $order->status = 2;
           if($driver->is_company == 1){
             
           $order->company_id = $request->driver_id;  
             
           }else{
              $order->driver_id = $request->driver_id; 
           }
              $order->insert_order_driver = now(); 
             $order->save();
              $seller = Seller::where('id',$order->seller_id)->first();
               $user = User::where("id",$order->user_id)->first();
   
      $title ="اشعار جديد";
        $text =  "تم اسناد طلب جديد لديك برقم ".$order->id." من مطعم ".$seller->name;
             $notification = new Notification;
             $notification->driver_id = $request->driver_id;
             $notification->title =$title;
             $notification->text = $text;
             $notification->save();
          $to = $driver->device_token;
        
           $noti_class = new SendNotification();
           
          $noti_class->send($to,$notification->title,$notification->text);
          
         return response()->json(['status' => true,'message' => 'تم تغيير السائق بنجاح']);
        
    }
    
    public function choosecompany(Request $request){
           $driver = Driver::whereId($request->company_id)->first();
             $order = Order::where('id',$request->id)->first();
           //  $order->status = 2;
        
             
           $order->company_id = $request->company_id;  
             
         
              $order->insert_order_company = now(); 
             $order->save();
              $seller = Seller::where('id',$order->seller_id)->first();
               $user = User::where("id",$order->user_id)->first();
   
      $title ="اشعار جديد";
        $text =  "تم اسناد طلب جديد لديك برقم ".$order->id." من مطعم ".$seller->name;
             $notification = new Notification;
             $notification->driver_id = $request->company_id;
             $notification->title =$title;
             $notification->text = $text;
             $notification->save();
          $to = $driver->device_token;
        
           $noti_class = new SendNotification();
           
          $noti_class->send($to,$notification->title,$notification->text);
          
         return response()->json(['status' => true,'message' => 'تم ادراج الى شركه التوصيل  بنجاح']);
        
    }
    
    public function changeorderstatus_id(Request $request){
        $order = Order::where('id',$request->id)->first();
        $order->status = $request->orderstatus_id;
  
        $order->save();
        $user = User::Where("id",$order->user_id)->first();
          $key = $this->notification_key();
        $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->title ="اشعار جديد";
        $notification->text = "تم تغيير حاله الطلب";
        $notification->save();
        
         $to = $user->device_token;
         
        $noti_class = new SendNotification;
        
          $noti_class->send($to,$notification->title,$notification->text);
          
         return response()->json(['status' => true]);
        
    }public function delivery_fee(Request $request){
        $order = Order::where('id',$request->order_id)->first();
        $order->price -= $order->delivery_fee;
        $order->priceafterdiscount -= $order->delivery_fee;
        $order->save();
        $order->delivery_fee = $request->delivery_fee;
        $order->price += $request->delivery_fee;
        $order->priceafterdiscount += $request->delivery_fee;
        $order->save();
        return  response()->json(['status' => true]);
    }public function checkres($id){
        $order = Order::where('id',$id)->first(); 
        $order->vertfiy_res = 1;
        $order->save();
         return  response()->json(['status' => true]);
    }public function change_delivery_status(Request $request){
        $order = Order::where('id',$request->id)->first();
        $order->delivery_status = $request->orderstatus_id;
          if($request->orderstatus_id == 1){
              $order->driver_accept = now();
              $order->save();
              
          } if($request->orderstatus_id == 2){
              $order->driver_waiting_order = now();
               $order->save();
          } if($request->orderstatus_id == 3){
              $order->driver_pickup = now();
               $order->save();
          } if($request->orderstatus_id == 4){
              $order->driver_waiting_client = now();
               $order->save();
          }
      if($request->orderstatus_id == 5){
           $order->status = 3;
             $order->delivery_time = now();
      }
        $order->save();
      
         return response()->json(['status' => true]);
        
    }public function dailyorders(DailyOrderDataTable $dataTable)
    {
   $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.orders.dailyorders',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    
  }

}
