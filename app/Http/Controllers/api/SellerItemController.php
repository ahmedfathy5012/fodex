<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Http\Resources\ItemResource;
use Carbon\Carbon;
use App\traits\ApiTrait;
use App\Models\Item;
use Validator;

class SellerItemController extends Controller
{
    use ApiTrait;
   public function seller_menu(Request $request){
        $rules = [
            "seller_id" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
       $seller =  Seller::where("id",$request->seller_id)->first();
       $items = Item::where("seller_id",$request->seller_id)->get();
   if(!$seller){
             $msg = 'لا يوجد مطعم بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
      $msg = "seller menu";
             return $this->dataResponse($msg,ItemResource::collection($items),200);
    }
}