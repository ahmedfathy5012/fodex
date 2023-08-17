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
use App\Models\Coupon;
use App\Models\Extradetail;
use App\Models\Size;
use App\Models\OrderItemExtra;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdertemResource;
use Carbon\Carbon;
class CurrentOrderController extends Controller
{
    public function current_orders(){
        $user = auth()->user();
        $orders = Order::where(function($a) {
             $a->whereNotIn('status',[4,3])->OrWhere("cancel",1);
            })
          ->orderBy("id","desc")->where("user_id",$user->id)->get(); 
        $msg = 'طلباتك الحاليه';
        return response()->json(['status' => true ,
        'message' => $msg,
        'data' =>OrderResource::collection($orders) ]);
    }public function last_orders(){
         $user = auth()->user();
                 $orders = Order::where(function($a) {
             $a->where('status',3)->OrWhere("cancel",1);
            })->orderBy("id","desc")->where("user_id",$user->id)->get(); 
        $msg = 'طلباتك الاخيره';
        return response()->json(['status' => true ,
        'message' => $msg,
        'data' =>OrderResource::collection($orders) ]);
    }
}