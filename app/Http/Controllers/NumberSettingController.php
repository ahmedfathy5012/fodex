<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NumberSetting;
class NumberSettingController extends Controller 
{
    public function edit(){
        $setting = NumberSetting::first();
        return view('admindashboard.numbersetting.edit')->with('setting',$setting);
    }public function update(Request $request){
        $setting = NumberSetting::first();
        $setting->update($request->all());
        return redirect()->back();
    }
}