<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Seller;
use App\Http\Resources\ZoneResource;
use App\traits\ApiTrait;
class ZoneController extends Controller
{
    use ApiTrait;
    public function index(Request $request){
         try{
            $zones = Zone::with("areas")->get();
            if($request->seller_id){
            $seller =  Seller::where("id",$request->seller_id)->first();
   if(!$seller){
             $msg = 'لا يوجد مطعم بهذا  الاسم';
               return $this->errorResponse($msg,404);
         }
          $msg = "مناطق المطعم ";
             return $this->dataResponse($msg,ZoneResource::collection($seller->zones_of_seller),200);
            }else{
              $msg = "كل المناطق";
             return $this->dataResponse($msg,ZoneResource::collection($zones),200);
            }
         }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}