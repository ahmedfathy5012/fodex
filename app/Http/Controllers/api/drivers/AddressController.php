<?php

namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Driver;
use App\Models\Address;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DriverResource;
use App\traits\ApiTrait;
use App\Events\DriverMoved;

class AddressController extends Controller
{
    use ApiTrait;
    public function updatelatlon(Request $request){
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
              $address = Address::where("driver_id",auth()->id())->first();
              if($address){
                  $address->update([
                      "lat" => $request->lat,
                      "lon" => $request->lon
                      ]);
                      event(new DriverMoved($request->lat,$request->lon,$user->name));
                       $msg = "تم تعديل  العنوان بنجاح";
             return $this->successResponse($msg,200);
              }else{
                  $address = Address::create([
                      "driver_id" => auth()->id(),
                    "lat" => $request->lat,
                      "lon" => $request->lon
                      ]);
                       event(new DriverMoved($request->lat,$request->lon,$user->name));
                       $msg = "تم تعديل  العنوان بنجاح";
             return $this->successResponse($msg,200);
              }
          }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}