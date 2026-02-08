<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Http\Resources\PaymentResource;
use Carbon\Carbon;
use App\traits\ApiTrait;
use App\Models\Zone;
use Validator;

class SellerPaymentMethodController extends Controller
{
    use ApiTrait;
   public function seller_payment_methods(Request $request){
        $rules = [
            "seller_id" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
       $seller =  Seller::where("id",$request->seller_id)->first();
   if(!$seller){
             $msg = 'لا يوجد مطعم بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
      $msg = "طرق الدفع الخاصه بالمطعم";
             return $this->dataResponse($msg,PaymentResource::collection($seller->payments),200);
    }
}