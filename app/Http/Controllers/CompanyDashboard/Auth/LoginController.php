<?php

namespace App\Http\Controllers\CompanyDashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    public function index(){
        return view('companydashboard.auth.login');
    }
    public function login(Request $request){
        $validators =[];
        $validators['phone'] = ['required'];
        $validators['password'] = ['required'];
    $request->validate($validators);
        if (auth()->guard('driver')->attempt(['phone' => $request->phone, 'password' => $request->password],$request->remember)) {
          return redirect()->route('company_captions.index')->with(['success'=> "تم تسجيل الدخول بنجاح"]);
        }
        return redirect()->back()->with(['error'=> ("هناك خطأ فى رقم الهاتف وكلمه السر")]);
    } public function companylogout(Request $request){
    
       auth()->guard('driver')->logout();
          return redirect()->route('companylogin')->with(['success'=> "تم تسجيل الخروج بنجاح"]);
  
    } 
}
