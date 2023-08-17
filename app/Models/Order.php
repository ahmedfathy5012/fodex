<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\User;
use App\Models\Seller;
use App\Models\Address;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Payment;
use Carbon\Carbon;
class Order extends Model
{
    protected $guarded = [];
    protected $table = "orders";
     protected $appends = [
        'time_accept',
        'order_time',
        'time_preparation',
        'time_delivery'
        
    ];
    public function items(){
        return $this->hasMany(OrderItem::class,'order_id');
    } public function user(){
        return $this->belongsTo(User::class,'user_id');
    }public function driver(){
        return $this->belongsTo(Driver::class,'driver_id');
    }public function company(){
        return $this->belongsTo(Driver::class,'company_id');
    }public function seller(){
        return $this->belongsTo(Seller::class,'seller_id');
    }  public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    } public function getTimeAcceptAttribute(){
       
          
   
                    // $accepted_at=\Carbon\Carbon::createFromTimestampUTC($order->accepted_at)->diffInMinutes();
                    // $created_at =\Carbon\Carbon::createFromTimestampUTC($order->created_at)->diffInMinutes();
                    // dd($created_at,$accepted_at);
                   if($this->accepted_at){
                       $number = $this->created_at->diffForHumans($this->accepted_at, true);

             }else{
                 $number = null;
             }
        return $number;
    }
    // public  function country_id(){
    //     return Address::where('seller_id',$this->seller->id)->first()->country_id;
    // }
    public function order_items(){
        return $this->hasMany(OrderItem::class,"order_id");
    } public function getMoneySellerCommissionAttribute(){
      
                if($this->order_commission){
                    $price = ($this->order_commission / 100) * ( $this->priceafterdiscount - $this->delivery_fee);
                

             }else{
                 $price = 0;
             }
        return $price;
    }public function getMoneyDriverCommissionAttribute(){
      
                if($this->order_commission){
                    $price = ($this->delivery_commission / 100) * $this->delivery_fee;
                

             }else{
                 $price = 0;
             }
        return $price;
    } public function payment(){
        return $this->belongsTo(Payment::class,'payment_method_id');
    } public function getOrderTimeAttribute(){
       $time = Carbon::parse($this->created_at)->format('Y-m-d g:i A');

        return $time;
    }public function getTimePreparationAttribute(){
                   if($this->preparation_time){
                       $number = $this->created_at->diffForHumans($this->preparation_time, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getTimeDeliveryAttribute(){
                   if($this->delivery_time){
                       $number = $this->created_at->diffForHumans($this->delivery_time, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getSellerAcceptTimeAttribute(){
                   if($this->seller_accept){
                       $number = $this->created_at->diffForHumans($this->seller_accept, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverPickupTimeAttribute(){
                   if($this->driver_pickup){
                       $number = $this->created_at->diffForHumans($this->driver_pickup, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverWaitingClientTimeAttribute(){
                   if($this->driver_waiting_client){
                       $number = $this->created_at->diffForHumans($this->driver_waiting_client, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverWaitingOrderTimeAttribute(){
                   if($this->driver_waiting_order){
                       $number = $this->created_at->diffForHumans($this->driver_waiting_order, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverAcceptTimeAttribute(){
                   if($this->driver_accept){
                       $number = $this->created_at->diffForHumans($this->driver_accept, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getInsertOrderDriverTimeAttribute(){
                   if($this->insert_order_driver){
                       $number = $this->created_at->diffForHumans($this->insert_order_driver, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getInsertOrderCompanyTimeAttribute(){
                   if($this->insert_order_driver){
                       $number = $this->created_at->diffForHumans($this->insert_order_company, true);

             }else{
                 $number = null;
             }
        return $number;
    }public function getSellerAcceptAfterAttribute(){
                   if($this->accepted_at && $this->seller_accept){
                       $number = Carbon::parse($this->accepted_at)->diffForHumans($this->seller_accept, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverAcceptAfterAttribute(){
                   if($this->insert_order_driver && $this->driver_accept){
                       $number = Carbon::parse($this->insert_order_driver)->diffForHumans($this->driver_accept, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getPreparationAfterAttribute(){
                   if($this->preparation_time && $this->seller_accept){
                       $number = Carbon::parse($this->seller_accept)->diffForHumans($this->preparation_time, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverReachSellerAttribute(){
                   if($this->driver_waiting_order && $this->driver_accept){
                       $number = Carbon::parse($this->driver_accept)->diffForHumans($this->driver_waiting_order, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverPickSellerAttribute(){
                   if($this->driver_waiting_order && $this->driver_pickup){
                       $number = Carbon::parse($this->driver_waiting_order)->diffForHumans($this->driver_pickup, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverReachClientAttribute(){
                   if($this->driver_waiting_client && $this->driver_pickup){
                       $number = Carbon::parse($this->driver_pickup)->diffForHumans($this->driver_waiting_client, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function getDriverPickClientAttribute(){
                   if($this->driver_waiting_client && $this->delivery_time){
                       $number = Carbon::parse($this->driver_waiting_client)->diffForHumans($this->delivery_time, true);
             }else{
                 $number = null;
             }
        return $number;
    }public function rate(){
        return $this->hasOne(OrderRate::class,"order_id");
    }public function getDriverRateAtrribute(){
       
        if($this->rate != null){
            $delivery_rate = $this->rate->delivery_rate;
        }else{
             $delivery_rate = null;
        }
        return $delivery_rate;
    }public function getSellerStatusNameAttribute(){
        $status ="";
        if($this->seller_status == 0){
            $status ="لم يتم ابلاغ المطعم";
        } if($this->seller_status == 1){
            $status ="المطعم وافق";
        } if($this->seller_status == 2){
            $status ="المطعم رفض";
        }
        return $status;
    }
}
