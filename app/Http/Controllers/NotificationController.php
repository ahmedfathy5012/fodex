<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Notification;
use App\User;
use App\Models\Driver;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\Zone;
use App\Models\Address;
use App\traits\generaltrait;
use App\Services\SendNotification;

class NotificationController extends Controller
{
    use generaltrait;
    public function notification()
    {   $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
      return view('admindashboard.notifications.sendnotification',compact("countries","states","cities","zones"));
    }public function storenotification(Request $request){
       // dd($request->all());
               $validator = Validator::make($request->all(), [
    		'title'    => 'required',
    		'text'=>'required',
    // 		'user_type' => 'required',
    	
	    	],[
    	 //  'user_type.required' => 'حقل المستخدمين مطلوب' ,
    	   'text.required' => 'حقل النص مطلوب',
    	    'title.required' => 'حقل العنوان مطلوب',
    	    ]);
    	   
            if($validator->passes()){
            //  if($request->country_id != 0 && $request->state_id != 0 && $request->city_id != 0 && $request->zone_id != 0){
            //      $user_ids = Address::where("zone_id",$request->zone_id)->get()->pluck("user_id");
            //  }else if($request->country_id != 0 && $request->state_id != 0 && $request->city_id != 0){
            //      $user_ids = Address::where("city_id",$request->city_id)->get()->pluck("user_id");
            //  }else if($request->country_id != 0 && $request->state_id != 0 ){
            //      $user_ids = Address::where("state_id",$request->state_id)->get()->pluck("user_id");
            //  }else if($request->country_id != 0 ){
            //      $user_ids = Address::where("country_id",$request->country_id)->get()->pluck("user_id");
            //  }else{
                 $users =User::whereHas("address",function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("country_id",$request->country_id);
                    });
                // });
                $query->when($request->state_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("state_id",$request->state_id);
                    // });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("city_id",$request->city_id);
                    // });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("zone_id",$request->zone_id);
                    // });
                });
              
           
        })->get();
   
               $key = $this->notification_key();
              
                    foreach($users as $user){
       $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->save();
         $to = $user->device_token;
     $noti_class = new SendNotification;
          $noti_class->send($to,$notification->title,$notification->text);
                        
                    }
                        return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
            }else{
                    return response()->json(['status' => false,'message' =>  $validator->messages()->first()]);
            }
    } public function notificationdriver()
    {   $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
      return view('admindashboard.notifications.sendnotificationdriver',compact("countries","states","cities","zones"));
    }public function storenotificationdriver(Request $request){
       // dd($request->all());
               $validator = Validator::make($request->all(), [
    		'title'    => 'required',
    		'text'=>'required',
    // 		'user_type' => 'required',
    	
	    	],[
    	 //  'user_type.required' => 'حقل المستخدمين مطلوب' ,
    	   'text.required' => 'حقل النص مطلوب',
    	    'title.required' => 'حقل العنوان مطلوب',
    	    ]);
            if($validator->passes()){
            $drivers =Driver::whereHas("address",function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("country_id",$request->country_id);
                    });
                // });
                $query->when($request->state_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("state_id",$request->state_id);
                    // });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("city_id",$request->city_id);
                    // });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                //  $q->wherehas("address",function($qq) use($request){
                        return $q->where("zone_id",$request->zone_id);
                    // });
                });
              
           
        })->get();
               
                    foreach($drivers as $user){
$notification = new Notification;
        $notification->driver_id = $user->id;
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->save();
         $to = $user->device_token;
         
       $noti_class = new SendNotification;
          $noti_class->send($to,$notification->title,$notification->text);
                        
                    }
                        return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
            }else{
                    return response()->json(['status' => false,'message' =>  $validator->messages()->first()]);
            }
    } public function senddriversnoti()
    {  
        $drivers = Driver::select("name","id")->where("is_company",0)->get();
      return view('admindashboard.notifications.senddriversnoti',compact("drivers"));
    }public function storedriversnoti(Request $request){
    
               $validator = Validator::make($request->all(), [
    		'title'    => 'required',
    		'text'=>'required',
    // 		'user_type' => 'required',
    	
	    	],[
    	 //  'user_type.required' => 'حقل المستخدمين مطلوب' ,
    	   'text.required' => 'حقل النص مطلوب',
    	    'title.required' => 'حقل العنوان مطلوب',
    	    ]);
            if($validator->passes()){
            
                    $drivers = Driver::whereIn("id",$request->driver_ids)->get();
               
                    foreach($drivers as $user){
$notification = new Notification;
        $notification->driver_id = $user->id;
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->save();
         $to = $user->device_token;
         
       $noti_class = new SendNotification;
          $noti_class->send($to,$notification->title,$notification->text);
                        
                    }
                        return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
            }else{
                    return response()->json(['status' => false,'message' =>  $validator->messages()->first()]);
            }
    }public function sendusersnoti()
    {  
        $users = User::select("name","id")->get();
      return view('admindashboard.notifications.sendusersnoti',compact("users"));
    }public function storeusersnoti(Request $request){
     //  dd($request->all());
               $validator = Validator::make($request->all(), [
    		'title'    => 'required',
    		'text'=>'required',
    // 		'user_type' => 'required',
    	
	    	],[
    	 //  'user_type.required' => 'حقل المستخدمين مطلوب' ,
    	   'text.required' => 'حقل النص مطلوب',
    	    'title.required' => 'حقل العنوان مطلوب',
    	    ]);
            if($validator->passes()){
            
                    $users = User::whereIn("id",$request->user_ids)->get();
               
                    foreach($users as $user){
      $notification = new Notification;
        $notification->user_id = $user->id;
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->save();
         $to = $user->device_token;
         
     $noti_class = new SendNotification;
          $noti_class->send($to,$notification->title,$notification->text);
                    }
                        return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
            }else{
                    return response()->json(['status' => false,'message' =>  $validator->messages()->first()]);
            }
    }public function sendcompanysnoti()
    {  
        $drivers = Driver::select("name","id")->where("is_company",1)->get();
      return view('admindashboard.notifications.sendcompanysnoti',compact("drivers"));
    }public function storecompanysnoti(Request $request){
    
               $validator = Validator::make($request->all(), [
    		'title'    => 'required',
    		'text'=>'required',
    // 		'user_type' => 'required',
    	
	    	],[
    	 //  'user_type.required' => 'حقل المستخدمين مطلوب' ,
    	   'text.required' => 'حقل النص مطلوب',
    	    'title.required' => 'حقل العنوان مطلوب',
    	    ]);
            if($validator->passes()){
            
                    $drivers = Driver::whereIn("id",$request->driver_ids)->get();
               
                    foreach($drivers as $user){
$notification = new Notification;
        $notification->driver_id = $user->id;
        $notification->title = $request->title;
        $notification->text = $request->text;
        $notification->save();
         $to = $user->device_token;
         
       $noti_class = new SendNotification;
          $noti_class->send($to,$notification->title,$notification->text);
                        
                    }
                        return response()->json(['status' => true,'message' => 'تم ارسال الاشعارات بنجاح']);
            }else{
                    return response()->json(['status' => false,'message' =>  $validator->messages()->first()]);
            }
    }
}