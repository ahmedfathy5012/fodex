<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Item;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\Models\Coupon;
use Carbon\Carbon;
use App\User;
use App\Models\DashboardNotification;
class DashboardController extends Controller
{
    public function index(){
        $now = Carbon::now()->format('Y-m-d');
        $sellers = Seller::all();
        $employees = Employee::all();
        $drivers = Driver::all();
       $orders = Order::where("status",1)->get();
        $dailyorders = Order::where("status",1)->where('created_at',Carbon::now())->get();
        $notifications = DashboardNotification::where("date",$now)->get()->take(1);
        $top_users = User::withCount("acceptorders")->orderBy("acceptorders_count","desc")->take(5)->get();
         $top_drivers = Driver::withCount("acceptorders")->orderBy("acceptorders_count","desc")->take(5)->get();
         $coupons = Coupon::whereDate("date_to",">",$now)->get();
         $daily_orders = count(Order::whereDate("created_at",Carbon::now())->get());
         $count_sellers =count($sellers);
          $count_employees =count($employees);
          $count_drivers =count($drivers); 
          $seller_types = Seller::withCount("done_orders")->orderBy("done_orders_count","desc")
->take('5')->get();
            $sellers_names =[];
            $seller_order_numbers=[];
       foreach($seller_types as $seller_type){
           $sellers_names[]= $seller_type->name;
           $seller_order_numbers[]=$seller_type->done_orders_count;
       }
       
                $driver_types = Driver::withCount("done_orders")->orderBy("done_orders_count","desc")
->take('5')->get();
            $drivers_names =[];
            $driver_order_numbers=[];
       foreach($driver_types as $driver_type){
           $drivers_names[]= $driver_type->name;
           $driver_order_numbers[]=$driver_type->done_orders_count;
       }
          $user_types = User::withCount("done_orders")->orderBy("done_orders_count","desc")
->take('5')->get();
            $users_names =[];
            $user_order_numbers=[];
       foreach($user_types as $user_type){
           $users_names[]= $user_type->name;
           $user_order_numbers[]=$user_type->done_orders_count;
       }
        return view("admindashboard.mainpage.index",compact("count_sellers","count_drivers","count_employees","daily_orders",
        "sellers_names","seller_order_numbers","drivers_names","driver_order_numbers","users_names","user_order_numbers","orders","dailyorders","notifications","top_users","top_drivers","coupons"));
    }public function mostresitems(){
        $zone_ids = auth()->user()->zones->pluck('id')->toArray();
        $sellers = Seller::withCount("items")->orderByDesc('items_count')->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($sellers as $seller){
       $names[]= $seller->name;
       $numbers[]=$seller->items_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostsellerorder(){
        $zone_ids = auth()->user()->zones->pluck('id')->toArray();
        $sellers = Seller::withCount("acceptorders")->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($sellers as $seller){
       $names[]= $seller->name;
       $numbers[]=$seller->acceptorders_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostdriverorder(){
        $zone_ids = auth()->user()->zones->pluck('id')->toArray();
        $drivers = Driver::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($drivers as $driver){
       $names[]= $driver->name;
       $numbers[]=$driver->acceptorders_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostitemorder(){
        $zone_ids = auth()->user()->zones->pluck('id')->toArray();
        $items = Item::get()->sortByDesc("count_number")->take('10');
        $names =[];
   $numbers=[];
   foreach($items as $item){
       $names[]= $item->title;
       $numbers[]=$item->count_number;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostcountryorder(){
        
          $countries = Country::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($countries as $country){
       $names[]= $country->name;
       $numbers[]=$country->acceptorders_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostcountryprice(){
          $countries = Country::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($countries as $country){
       $names[]= $country->name;
         $number =0;
                   foreach($country->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers[]=$number;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }
    //state
    public function moststateorder(){
          $states = State::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($states as $state){
       $names[]= $state->name;
       $numbers[]=$state->acceptorders_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function moststateprice(){
          $states = State::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($states as $state){
       $names[]= $state->name;
         $number =0;
                   foreach($state->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers[]=$number;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }
    //city
    public function mostcityorder(){
          $cities = City::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($cities as $city){
       $names[]= $city->name;
       $numbers[]=$city->acceptorders_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostcityprice(){
          $cities = City::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($cities as $city){
       $names[]= $city->name;
         $number =0;
                   foreach($city->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers[]=$number;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }
    //zone
    public function mostzoneorder(){
          $zones = Zone::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($zones as $zone){
       $names[]= $zone->name;
       $numbers[]=$zone->acceptorders_count;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function mostzoneprice(){
            $zones = Zone::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names =[];
   $numbers=[];
   foreach($zones as $zone){
       $names[]= $zone->name;
         $number =0;
                   foreach($zone->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers[]=$number;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }public function fastemployeeorder(){
        $zone_ids = auth()->user()->zones->pluck('id')->toArray();
        $employees = Employee::withCount("acceptorders")->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->take('10')->get()->sortBy('time_accept');
        $names =[];
   $numbers=[];
   foreach($employees as $employee){
       $names[]= $employee->name;
       $numbers[]=$employee->time_accept;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    } public function filter_dashboard(Request $request){
      
        $now = Carbon::now()->format('Y-m-d');
        $sellers = Seller::where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->get();
      
        $employees = Employee::where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->get();
        $drivers = Driver::where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->get();
       $orders = Order::where("status",1)->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                   
                    return $q->where("country_id",$request->country_id);
                });
                $query->when($request->state_id != 0,function($q) use($request){
                   
                    return $q->where("state_id",$request->state_id);
                });$query->when($request->city_id != 0,function($q) use($request){
                   
                    return $q->where("city_id",$request->city_id);
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                   
                    return $q->where("zone_id",$request->zone_id);
                });
                })->get();
        $dailyorders = Order::where("status",1)->where('created_at',Carbon::now())
        ->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                   
                    return $q->where("country_id",$request->country_id);
                });
                $query->when($request->state_id != 0,function($q) use($request){
                   
                    return $q->where("state_id",$request->state_id);
                });$query->when($request->city_id != 0,function($q) use($request){
                   
                    return $q->where("city_id",$request->city_id);
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                   
                    return $q->where("zone_id",$request->zone_id);
                });
                })->get();
        $top_users = User::withCount("acceptorders")->orderBy("acceptorders_count","desc")->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->take(5)->get();
         $top_drivers = Driver::withCount("acceptorders")->orderBy("acceptorders_count","desc")->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->take(5)->get();
         $daily_orders = count(Order::whereDate("created_at",Carbon::now())->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                   
                    return $q->where("country_id",$request->country_id);
                });
                $query->when($request->state_id != 0,function($q) use($request){
                   
                    return $q->where("state_id",$request->state_id);
                });$query->when($request->city_id != 0,function($q) use($request){
                   
                    return $q->where("city_id",$request->city_id);
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                   
                    return $q->where("zone_id",$request->zone_id);
                });
                })->get());
         $count_sellers =count($sellers);
          $count_employees =count($employees);
          $count_drivers =count($drivers); 
          $seller_types = Seller::withCount("done_orders")->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->orderBy("done_orders_count","desc")
->take('5')->get();
            $sellers_names =[];
            $seller_order_numbers=[];
       foreach($seller_types as $seller_type){
           $sellers_names[]= $seller_type->name;
           $seller_order_numbers[]=$seller_type->done_orders_count;
       }
       
                $driver_types = Driver::withCount("done_orders")->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->orderBy("done_orders_count","desc")
->take('5')->get();
            $drivers_names =[];
            $driver_order_numbers=[];
       foreach($driver_types as $driver_type){
           $drivers_names[]= $driver_type->name;
           $driver_order_numbers[]=$driver_type->done_orders_count;
       }
          $user_types = User::withCount("done_orders")->where(function ($query) use ($request) {
            $query->when($request->country_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("country_id",$request->country_id);
                    });
                });
                $query->when($request->state_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("state_id",$request->state_id);
                    });
                });
                $query->when($request->city_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("city_id",$request->city_id);
                    });
                });
                $query->when($request->zone_id != 0,function($q) use($request){
                 $q->wherehas("address",function($qq) use($request){
                        return $qq->where("zone_id",$request->zone_id);
                    });
                });
              
           
        })->orderBy("done_orders_count","desc")
->take('5')->get();
            $users_names =[];
            $user_order_numbers=[];
       foreach($user_types as $user_type){
           $users_names[]= $user_type->name;
           $user_order_numbers[]=$user_type->done_orders_count;
       }
       return response()->json(['status' => true,
       "data" => ["count_sellers" => $count_sellers,"count_drivers" =>  $count_drivers,
       "count_employees" => $count_employees,"daily_orders" => $daily_orders,
        "sellers_names" => $sellers_names ,"seller_order_numbers" => $seller_order_numbers,
        "drivers_names" => $drivers_names,"driver_order_numbers" => $driver_order_numbers
        ,"users_names" => $users_names, "user_order_numbers" => $user_order_numbers,
        "orders" => $orders,"dailyorders" => $dailyorders
        ,"top_users" => $top_users,"top_drivers" => $top_drivers]]);
    }
}