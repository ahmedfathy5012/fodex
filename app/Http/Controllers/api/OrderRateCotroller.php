<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderRate;
use App\User;
use App\Models\Order;
use App\Models\Seller;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\SellerResource;
class OrderRateController extends Controller
{
    public function rate_order(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(),[
            'order_id' => "required",
            'seller_rate'=> 'max:5|numeric',
            'delivery_rate'=> 'max:5|numeric',
            ]);
            if($validator->passes()){
        $order = Order::where("id",$request->order_id)->first();
        if($order){
         $rate = new OrderRate;
         $rate->user_id = auth()->id();
         $rate->seller_rate = $request->seller_rate;
         $rate->delivery_rate = $request->delivery_rate;
         $rate->order_id = $request->id;
         $rate->save();
          return response()->json(['status'=> true,'message'=> ' تم ارسال التقييم بنجاح '
          ]);
        }else{
            return response()->json(['status' => false,'message' => 
            'لا يوجد طلب بهذا الاسم'],404);
        }                
            }else{
                return response()->json(['status' => false,'message' => $validator->errors()->first()],422);
            }
    }
    }