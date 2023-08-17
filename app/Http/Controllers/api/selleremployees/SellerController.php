<?php

namespace App\Http\Controllers\api\selleremployees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerEmployee;
use App\Models\Seller;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\traits\ApiTrait;

class SellerController extends Controller
{
    use ApiTrait;
    public function set_seller_status(){
        try{
              $user = auth()->user();
              
             $seller = Seller::where("id",$user->seller_id)->first();
              if(!$seller){
             $msg = 'لا يوجد بائع بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
         $seller->availability = !$seller->availability;
         $seller->save();
             $msg = "تم تغيير حاله البائع بنجاح";
             return response()->json(["status" => true,
             "message" => $msg,
             "availability_status" => $seller->availability ? 1 :0]);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}