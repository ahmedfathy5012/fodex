<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function adminlogin(){
        return view('login.adminlogin');
    }public function login(Request $request){
        $validators =[];
        $validators['name'] = ['required'];
        $validators['password'] = ['required'];
    $request->validate($validators);
        if (auth()->guard('employee')->attempt(['name' => $request->name, 'password' => $request->password],$request->remember)) {
            return redirect()->route('dashboard')->with(['success'=> "تم تسجيل الدخول بنجاح"]);
        }
        return redirect()->back()->with(['error'=> ("هناك خطأ فى الاسم وكلمه السر")]);
    }  public function sellerlogin(){
       
        return view('login.sellerlogin');
    }public function sellerlogindash(Request $request){
         $this->validate($request, [
            'phone'   => 'required',
            'password' => 'required'
        ]);
   
        if (auth()->guard('selleremployee')->attempt(['phone' => $request->phone, 'password' => $request->password],$request->remember)) {
               
            return redirect()->route('myorders');
        }
        return redirect()->back();
    }public function sellerlogout(){
        auth()->guard('selleremployee')->logout();
        return redirect()->route("sellerlogin");
    }public function adminlogout(){
        auth()->guard('employee')->logout();
        return redirect()->route("adminlogin");
    }
}
