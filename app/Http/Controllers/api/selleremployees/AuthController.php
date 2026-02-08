<?php

namespace App\Http\Controllers\api\selleremployees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\SellerEmployee;
use App\Models\Address;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\SellerEmployeeResource;
use App\traits\ApiTrait;
class AuthController extends Controller
{
    use ApiTrait;
   public function login(Request $request){
     try {
            //validation

            $rules = [
                "phone" => "required",
                "password" => "required|min:6",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            $user = SellerEmployee::wherePhone($request->phone)->first();

            //check if user exist

            if ($user) {

                 //token 
               $token = auth()->guard('selleremployee')->attempt($request->only(['phone', 'password']));
                if ($token) {

                    //update user

                   $user->api_token = Hash::make(rand(12,9999999474));
                   $user->device_token = $request->device_token;
                   $user->save();
                    //response
                    
                    $msg = "تم تسجيل الدخول  بنجاح";
                    return $this->dataResponse($msg, new SellerEmployeeResource($user));
                } else {
                    $msg = 'كلمه السر خاطئه';
                    return $this->errorResponse($msg, 401);
                }
            } else {
                $msg = 'لا يوجد مستخدم بهذا الهاتف';
                return $this->errorResponse($msg, 404);
            }
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }public function change_password(Request $request)
    {
        try {

            //validation

            $rules = [
                "old_password" => "required|min:6",
                "new_password" => "required|min:6",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            $user = auth()->user();

            //check if old password and new password if the same

            if (Hash::check($request->old_password, auth()->user()->password)) {

                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);

                //response

                $msg = " تم تغيير كلمه السر بنجاح ";
                return $this->dataResponse($msg, new SellerEmployeeResource($user),200);
            } else {
                $msg = 'كلمه السر القيديمه لا تطابق كلمه سر المستخدم';
                return $this->errorResponse($msg, 401);
            }
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }public function reset_password(Request $request)
    {
        try {
           
            //validation

            $rules = [
                "phone" => "required",
                "password" => "required|min:6",
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            $user = SellerEmployee::wherePhone($request->phone)->first();

            //check if user exist

            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                //response

                $msg = " تم تغيير كلمه السر بنجاح ";
                return $this->dataResponse($msg, new SellerEmployeeResource($user), 200);
            } else {
                $msg = 'لا يوجد مستخدم بهذا الهاتف';
                return $this->errorResponse($msg, 404);
            }
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }   public function phone_exist(Request $request)
    {
        try {

            //validation

            $rules = [
                "phone" => "required",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->getvalidationErrors($validator);
            }
            $user = SellerEmployee::wherePhone($request->phone)->first();

            //check if user exist

            if ($user) {
                $msg = "تم ايجاد المستخدم بنجاح";
                return $this->dataResponse($msg, new SellerEmployeeResource($user));
            } else {
                $msg = 'لا يوجد مستخدم بهذا الهاتف';
                return $this->errorResponse($msg, 404);
            }
        } catch (\Exception$ex) {
            return $this->returnException($ex->getMessage(), 500);
        }
    }
}
