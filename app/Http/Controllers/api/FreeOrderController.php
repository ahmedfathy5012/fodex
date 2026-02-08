<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\User;
use App\Models\FreeOrder;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CouponResource;
class FreeOrderController extends Controller
{
public function add_free_orders(Request $request){
 
        $user = auth()->user();
        $validator = Validator::make($request->all(),[
            'order_text' => "required"],
            [
            'required' => 'حقل النص مطلوب'    ]);
            if($validator->passes()){

         $order = new FreeOrder;
         $order->text = $request->order_text;
         $order->user_id = $user->id;
         if($request->order_image){
             $image = $request->order_image;
          $imageName = \Str::random(10).'.'. 'png';
 Storage::disk('uploads')->put($imageName, base64_decode($image));
            $order->image = $imageName; 
         }
         $order->save();
         return response()->json(['status' => true,'message' => 'تم ارسال الطلب بنجاح'],200);
            }else{
                return response()->json(['status' => false,'message' => $validator->errors()->first()],422);
            }
        
    }
}