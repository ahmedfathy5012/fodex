<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NumberSetting;

class NumberSettingController extends Controller
{
    public function edit()
    {
        $setting = NumberSetting::first();

        return view('admindashboard.numbersetting.edit')->with('setting', $setting);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'res_distance' => ['required', 'numeric', 'min:0'],
            'driver_sallary' => ['required', 'numeric', 'min:0'],
            'driver_commission' => ['required', 'numeric', 'min:0'],
            'driver_least_price' => ['required', 'numeric', 'min:0'],
            'res_percentage' => ['required', 'numeric', 'min:0'],
        ]);

        $setting = NumberSetting::first() ?? new NumberSetting();
        $setting->fill($validated);
        $setting->save();

        return redirect()->back()->with('success', 'تم حفظ الإعدادات بنجاح');
    }



//    public function edit(){
//        $setting = NumberSetting::first();
//        return view('admindashboard.numbersetting.edit')->with('setting',$setting);
//    }public function update(Request $request){
//    $setting = NumberSetting::first();
//    $setting->update($request->all());
//    return redirect()->back();
//}
}
