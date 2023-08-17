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
class AuthController extends Controller
{
   public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required'
           
        ],[
            'phone.required' => 'حقل الهاتف  مطلوب',
            'password.required' => 'حقل كلمه السر  مطلوب',
         
        ]);
        try{
            if($validator->passes()){
                $credentials = $request->only(['phone', 'password']);
                $user = Driver::where('phone',$request->phone)->first();
                if (! $token = auth()->guard('driver')->attempt($credentials)) {
                    return response()->json(['status' => false,'message' => 'كلمه السر خطا'], 401);
                }else{
                   
                        $user->api_token = Hash::make($user->phone . rand(10,10000));
                        $user->device_token = $request->device_token;
                        $user->save();
                        return response()->json(['status' => true,'message' => 'تم تسجيل  الدخول بنجاح',
                     'data' => new DriverResource($user),
                      ]);
                   
                }
            }else{
                $msg = $validator->messages()->first();
                return response()->json(['status' => false,'message' => $msg]);
            }
        }catch(\Exception $e){
            $msg = 'حدث خطا ما حاول التسجيل لاحقا';
            return response()->json(['status' => false,'message' => $msg]);
        }
    }public function change_password(Request $request){
    $user = auth()->user();
    $validator = Validator::make($request->all(),[
        'old_password' => 'required',
    ],[
        'old_password.required' => 'حقل كلمه السر  مطلوب',
    ]);

  try{
    if($validator->passes()){
    $password=Hash::check($request->old_password,auth()->user()->password);
    if($password == true){
        $user->password = Hash::make($request->new_password);
        $user->save();
        return Response()->json([
      'status'     =>  'true',
      'message' => 'تم تغيير الباسورد بنجاح',
     'data' => new DriverResource($user)
      ]);       
    }else{
        return Response()->json([
         'status'     =>  'false',
         'message'=> 'الباسورد خطا ',
         ],401);  
    }
}else{
        $msg = $validator->messages()->first();
        return response()->json(['status' => false,'message' => $msg]);
    }}catch(\Exception $e){
        $msg = 'حدث خطا ما حاول التسجيل لاحقا';
        return response()->json(['status' => false,'message' => $msg]);
    }
}public function reset_password(Request $request){
    $validator = Validator::make($request->all(),[
        'phone' => 'required',
        'password' => 'required',
    ],[
       'password.required' => 'حقل كلمه السر مطلوب  ',
         'phone.required' => 'حقل  الهاتف مطلوب  ',
    ]);
        try{
        if($validator->passes()){
     $user = Driver::where('phone',$request->phone)->first();
     if($user){
     $user->password = Hash::make($request->password);
     $user->save();
     return response()->json(['status' => true,'message'=> 'تم تغيير كلمه السر بنجاح '
     //,'data' =>
      ]);
    }else{
        return response()->json(['status' => false,'message' => 'لا يوجد مستخدم بهذا الرقم ']);
     }

        }else{
            $msg = $validator->messages()->first();
            return response()->json(['status' => false,'message' => $msg]);
        }
    }catch(\Exception $e){
        $msg = 'حدث خطا ما حاول التسجيل لاحقا';
        return response()->json(['status' => false,'message' => $msg]);
    }
}public function phone_exist(Request $request){
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
        ],[
            'phone.required' => 'حقل الهاتف  مطلوب',
        ]);
        try{
            if($validator->passes()){
           $user = Driver::where('phone',$request->phone)->first();
           if($user){
            return response()->json(['status' => true,'message' => 'تم البحث عن الهاتف بنجاح   ',
            'data' => new DriverResource($user),
            ]);
           }else{
            return response()->json(['status' => false,'message' => 'لا يوجد مستخدم بهذا الرقم ',
            ]);
           }
            }else{
                $msg = $validator->messages()->first();
                return response()->json(['status' => false,'message' => $msg]);
            }
     }  
     catch(\Exception $e){
        $msg = 'حدث خطا ما حاول التسجيل لاحقا';
        return response()->json(['status' => false,'message' => $msg]);
    }
}  public function change_driver_available(){
        try{
         $user = auth()->user();
         $user->available = !$user->available;
         $user->save();
             $msg = "تم تغيير حاله السائق بنجاح";
             return response()->json(["status" => true,
             "message" => $msg,
             "availability_status" => $user->available ? 1 :0]);
         
        }catch (\Exception $ex) {
         return $this->returnException( $ex->getMessage(),500);
       }
    }
}
