<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\traits\generaltrait;
use App\Http\Resources\SellerRateResourse;
use App\Models\SellerRate;
use Illuminate\Support\Facades\File; 
use App\traits\ApiTrait;
use Validator;
class SellerRateController extends Controller
{
     use generaltrait,ApiTrait;
    public function addsellerrate(Request $request){
        $rules = [
            "seller_id" => "required",
            'rate' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
        $rate = new SellerRate;
        $rate->rate = $request->rate;
        $rate->comment = $request->comment;
        $rate->seller_id = $request->seller_id;
        $rate->user_id = auth()->id();
          if($request->hasFile('image'))
        {
            $image = $this->uploadimage($request->image,'sellerrates');
            $rate->image = $image;
        }
        $rate->save();
        return response()->json(['status' => true,
        'message' => 'تم اضافه الكومنت بنجاح']);
    }public function sellersrates(Request $request){
        $rules = [
            "seller_id" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
       $rates =  SellerRate::where("seller_id",$request->seller_id)->get();
//       $value = 58.24365;
      $allrate = array_sum($rates->pluck('rate')->toArray());
      if($allrate > 0){
          $average_rate = $allrate / count($rates);
      $average_rate = (double)number_format($average_rate, 2, '.', '');
      }else{
          $average_rate =0;
      }
        return response()->json(['status' => true,
        'message' => 'all seller rates',
        'number_of_rates' => count($rates),
          'average_rate' =>$average_rate,
        'data' => SellerRateResourse::collection($rates),
      
        ]);
    }public function deletesellerrate(Request $request){
        $rate =  SellerRate::where("id",$request->rate_id)->first();
        if($rate){
            if(SellerRate::where("id",$request->rate_id)->where('user_id',auth()->id())->first()){
                $rate->delete();
                 return response()->json(['status' => true,
        'message' => 'تم مسح التعليق بنجاح']); 
            }else{
                return response()->json(['status' => false,
        'message' => 'لا تستطيع مسح هذا التعليق لانه ليس تعليقك']);  
            }
        }else{
            return response()->json(['status' => false,
        'message' => 'عفوا لايوجد rate بهذا ال id']); 
        }
    }
}