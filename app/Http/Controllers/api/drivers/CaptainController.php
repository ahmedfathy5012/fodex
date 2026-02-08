<?php
namespace App\Http\Controllers\api\drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\traits\ApiTrait;

use App\Http\Resources\CaptainResource;



use App\Models\Driver;

use Validator;
use Illuminate\Support\Facades\Hash;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




class CaptainController extends Controller
{
    use ApiTrait;
    public function add_captain(Request $request){
            try { 
                
                
        $rules = [
            "name" => "required",
            "phone" => "required|unique:drivers,phone",
            'start_shift' => 'required',
             'end_shift' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
        
        $driver = Driver::create([
            "name" => $request->name,
              "phone" => $request->phone,
              "start_shift" => $request->start_shift,
              "end_shift" => $request->end_shift,
              "password" =>Hash::make($request->phone),
              "driver_id" => auth()->id()
            ]);
            
             $msg =  "تم اضافه الكابتن بنجاح";
        
         return $this->dataResponse($msg, new CaptainResource($driver),200);
          } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }
    
        public function edit_captain(Request $request){
            try { 
                
                
        $rules = [
            "name" => "required",
           
            'start_shift' => 'required',
             'end_shift' => 'required',
             "driver_id" => "required",
              "phone" => "required|unique:drivers,phone,".$request->driver_id,

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
          $driver = Driver::whereId($request->driver_id)->first();
        
        if(!$driver){
            $msg ="لا يوجد كابتن بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
        $driver->update([
            "name" => $request->name,
              "phone" => $request->phone,
              "start_shift" => $request->start_shift,
              "end_shift" => $request->end_shift
            ]);
            
             $msg =  "تم  تعديل الكابتن بنجاح";
        
         return $this->dataResponse($msg, new CaptainResource($driver),200);
          } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }    public function my_captains(){
            try { 
                
                
        $drivers = Driver::where("driver_id",auth()->id())->get();
        
             $msg =  "my_captains   ";
        
         return $this->dataResponse($msg, CaptainResource::collection($drivers),200);
          } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
    }
        public function delete_captain(Request $request){
            try { 
                
                
        $rules = [
             "driver_id" => "required"

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
          $driver = Driver::whereId($request->driver_id)->first();
        
        if(!$driver){
            $msg ="لا يوجد كابتن بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
     $driver->delete();

            
             $msg =  "تم  مسح الكابتن بنجاح";
        
         return $this->successResponse($msg, 200);
          } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
}
        public function change_captain_status(Request $request){
            try { 
                
                
        $rules = [
             "driver_id" => "required"

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return $this->getvalidationErrors($validator);

        }
          $driver = Driver::whereId($request->driver_id)->first();
        
        if(!$driver){
            $msg ="لا يوجد كابتن بهذا الاسم";
                return $this->errorResponse($msg, 200);

        }
     $driver->available = $driver->available == 1 ? 0 : 1;
     $driver->save();
             $msg =  "تم  تغيير حاله الكابتن  بنجاح";
        
   return $this->dataResponse($msg, new CaptainResource($driver),200); 
   } catch (\Exception$ex) {
              return $this->returnException($ex->getMessage(), 500);
          }
}

}