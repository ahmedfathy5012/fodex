<?php

namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Driver;
use App\Models\AttendanceDriver;
use App\Models\CheckoutDriver;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\BoxResource;
use App\traits\ApiTrait;

class AttendanceDriverController extends Controller
{
    use ApiTrait;
   public function attendance_registration(Request $request){
          try{
                $rules = [
              "lat" => "required",
              "lon" => "required",
        ];
        $user = auth()->user();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         
         $boxtake = new AttendanceDriver;
         $boxtake->lat = $request->lat;
          $boxtake->lon = $request->lon;
          $boxtake->driver_id = auth()->id();
          $boxtake->save();
         $msg = "تم الحضور بنجاح   ";
             return $this->successResponse($msg,200);
          }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
   }  public function check_out(Request $request){
          try{
                $rules = [
              "lat" => "required",
              "lon" => "required",
        ];
        $user = auth()->user();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->getvalidationErrors($validator);
         } 
         
         $boxtake = new CheckoutDriver;
         $boxtake->lat = $request->lat;
          $boxtake->lon = $request->lon;
          $boxtake->driver_id = auth()->id();
          $boxtake->save();
         $msg = "تم الانصراف بنجاح   ";
             return $this->successResponse($msg,200);
          }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
   } 
}