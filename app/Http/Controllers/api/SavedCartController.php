<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Validator;
use App\Models\Size;
use App\Models\Item;
use App\Models\SavedCart;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Resources\CartItemResource;
class SavedCartController extends Controller
{
    public function save_cart(Request $request){
        $validator = Validator::make($request->all(),[
            'order_id' => "required"]);
            $order = Order::where("id",$request->order_id)->first();
            if($validator->passes()){
                if($order){
                $savedcart = new SavedCart;
                $savedcart->user_id = auth()->id();
                $savedcart->order_id = $request->order_id;
                $savedcart->save();
                 return response()->json(['status' => true,'message' => 'تم   الاضافه بنجاح']);
         }else{
            
               return response()->json(['status' => false,'message' => 
               'لا يوجد طلب بهذا الاسم'],404);
         }
            }else{
                return response()->json(['status' => false,'message' => $validator->errors()->first()],422);
            }
    } public function saved_carts(){
        $user = auth()->user();
         $order_ids =  SavedCart::where("user_id",auth()->id())->get()->pluck("order_id")->toArray();
         $orders = Order::whereIn("id",$order_ids)->get();
     
        $msg = ' saved_carts';
        return response()->json(['status' => true ,
        'message' => $msg,
        'data' =>OrderResource::collection($orders) ]);
    }
}