<?php

namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Driver;
use App\Models\BoxDeliver;
use App\Models\BoxTake;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\BoxResource;
use App\traits\ApiTrait;
use App\Events\DriverMoved;

class BoxController extends Controller
{
    use ApiTrait;
   public function receive_box(Request $request){
          try{
                $rules = [
            "box_code" => "required",
        ];
        $user = auth()->user();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
          $Box = Box::where("code",$request->box_code)->first();
         if(!$Box){
             $msg = 'لا يوجد صندوق بهذا  الكود';
               return $this->errorResponse($msg,404);
         }
         $boxtake = new BoxTake;
         $boxtake->box_id = $Box->id;
          $boxtake->driver_id = auth()->id();
          $boxtake->save();
         $msg = "تم   استلام الصندوق   بنجاح";
             return $this->dataResponse($msg,new BoxResource($Box),200);
          }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
   } public function box_delivery(Request $request){
          try{
                $rules = [
            "box_code" => "required",
        ];
        $user = auth()->user();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
          $Box = Box::where("code",$request->box_code)->first();
         if(!$Box){
             $msg = 'لا يوجد صندوق بهذا  الكود';
               return $this->errorResponse($msg,404);
         }
         $boxtake = new BoxDeliver;
         $boxtake->box_id = $Box->id;
          $boxtake->driver_id = auth()->id();
          $boxtake->save();
         $msg = "تم   استلام الصندوق   بنجاح";
             return $this->dataResponse($msg,new BoxResource($Box),200);
          }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
   }
    
}