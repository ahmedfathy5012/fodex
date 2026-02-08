<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\User;
use App\Models\Address;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\traits\ApiTrait;
class AuthController extends Controller
{
    use ApiTrait;
    public function tokeninvalid(){
         $msg =  'برجاء تسجيل الدخول ';
         return $this->errorResponse($msg,401);
      
          }
    // public function login_countries(){
    //     $countries = Country::orderBy('id','desc')->get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'كل الدول',
    //         'data' => $countries
    //         ]);}
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
          //  'email' => 'required|email|unique:users,email',
        ],[
            'phone.required' => 'حقل الهاتف  مطلوب',
            'password.required' => 'حقل كلمه السر  مطلوب',
            'name.required' => 'حقل الاسم  مطلوب',
          //  'email.required' => 'حقل  الايميل  مطلوب',
            'phone.unique' => 'هذا الهاتف موجود من قبل',
          //  'email.unique' => 'هذا الايميل موجود من قبل',
            'min' => 'كلمه السر لايجب ان تقل عن 6 احرف'
        ]);
        try{
            if($validator->passes()){
           $user = new User;
               $user->name = $request->name;
               $user->phone  = $request->phone;
          //     'email' => $request->email,
               $user->password  = Hash::make($request->password);
               $user->code  = $request->code;
              $user->device_token  = $request->device_token;
               $user->api_token = Hash::make(rand(1,9999999));
               $user->user_code =  mt_rand(100,999) .  mt_rand(100,999);
              // 'gender' => $request->gender,
          //     'usertype_id' => $request->usertype_id,
            //   'country_id' => $request->country_id
        //   ]);  
                $user->save();

           return response()->json(['status' => true,'message' => 'تم اضافه المستخدم بنجاح',
           'data' => new UserResource($user),
           ]);
            }else{
                $msg = $validator->messages()->first();
                return response()->json(['status' => false,'message' => $msg]);
            }
        }catch(\Exception $e){
            $msg = 'حدث خطا ما حاول التسجيل لاحقا';
            return response()->json(['status' => false,'message' => $msg]);
        }
    }public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
            'password' => 'required',
            'code' => 'required',
        ],[
            'phone.required' => 'حقل الهاتف  مطلوب',
            'password.required' => 'حقل كلمه السر  مطلوب',
            'code.required' => 'حقل  الكود  مطلوب',
        ]);
        try{
            if($validator->passes()){
                $credentials = $request->only(['phone', 'password']);
                $user = User::where('phone',$request->phone)->first();
                if (! $token = auth()->attempt($credentials)) {
                    return response()->json(['status' => false,'message' => 'كلمه السر خطا'], 401);
                }else{
                    if($user->code == $request->code){
                        $user->device_token = $request->device_token;
                        $user->save();
                        return response()->json(['status' => true,'message' => 'تم تسجيل  الدخول بنجاح',
                     'data' => new UserResource($user),
                      ]);
                    }else{
                        return response()->json(['status' => false,'message' => 'كود الدوله  خطا'], 401);
                    }
                }
            }else{
                $msg = $validator->messages()->first();
                return response()->json(['status' => false,'message' => $msg]);
            }
        }catch(\Exception $e){
            $msg = 'حدث خطا ما حاول التسجيل لاحقا';
            return response()->json(['status' => false,'message' => $msg]);
        }
    }public function verify_phone(){
        $user = auth()->user();
        $user->phone_verify = 1;
        $user->save();
        return response()->json(['status' => true,'message' => 'تم تفعيل كود الهاتف ' ,
      'data' => new UserResource($user)
      ]);
    }public function phone_exist(Request $request){
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
        ],[
            'phone.required' => 'حقل الهاتف  مطلوب',
        ]);
        try{
            if($validator->passes()){
           $user = User::where('phone',$request->phone)->first();
           if($user){
            return response()->json(['status' => true,'message' => 'تم البحث عن الهاتف بنجاح   ',
            'data' => new UserResource($user),
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
     'data' => new UserResource($user)
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
     $user = User::where('phone',$request->phone)->first();
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
}public function set_location(Request $request){
    $id = auth()->id();
    
    $address = Address::where('user_id',$id)->first();
    if($address){
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->save();
    }else{
        $address = new Address;
        $address->user_id = $id;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->save();
    }
    $user = User::where('id',$id)->first();
     return response()->json([
      'status'     =>  true,
      'message' => 'تم  الحفظ بنجاح',
     'data' => new UserResource($user)
      ]);    
}public function change_notify_status(Request $request){
    $user = auth()->user();
    $user->ordinary_notifications = $request->ordinary_notifications;
    $user->offers_otifications = $request->offers_otifications;
    $user->save();
      return response()->json([
      'status'     =>  true,
      'message' => 'تم  التغييير بنجاح'
      ]); 
}public function change_info(Request $request){
    $user = auth()->user();
  $data = [];
  if($request->name){
      $data["name"] = $request->name;
  }if($request->email){
      $data["email"] = $request->email;
  }
    $user->update($data);
     $msg = "تم التعديل  بنجاح";
             return $this->dataResponse($msg,new UserResource($user),200);
}
}
