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
class StatisticController extends Controller
{
    public function statistic(){
           $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return view("admindashboard.statistic.statistic",['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    }public function filtercharts(Request $request){
     
            $datepicker = explode(" - ",$request->get('datepicker'));
     $from = $datepicker[0];
     $to = $datepicker[1];
         $zone_ids = auth()->user()->zones->pluck('id')->toArray();
    if($request->country_id && $request->state_id  && $request->zone_id && $request->city_id){
        $zone_id = $request->zone_id;
             $sellers1 = Seller::withCount("items")->orderByDesc('items_count')
             ->whereHas('items', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($zone_id) 
{
    $q->where("zone_id",$zone_id);

})->take('10')->get();
        $names1 =[];
   $numbers1=[];
   foreach($sellers1 as $seller){
       $names1[]= $seller->name;
       $numbers1[]=$seller->items_count;
   }
  $sellers2 = Seller::withCount("acceptorders")->with("acceptorders")->orderByDesc('acceptorders_count')
  ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($zone_id) 
{
    $q->where("zone_id",$zone_id);

})->take('10')->get();
        $names2 =[];
  $numbers2=[];
  foreach($sellers2 as $seller){
      $names2[]= $seller->name;
      $numbers2[]=$seller->acceptorders_count;
  }
       $drivers = Driver::withCount("acceptorders")->orderByDesc('acceptorders_count')
      ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($zone_id) 
{
    $q->where("zone_id",$zone_id);

})->take('10')->get();
        $names3 =[];
  $numbers3=[];
  foreach($drivers as $driver){
      $names3[]= $driver->name;
      $numbers3[]=$driver->acceptorders_count;
  } 
$items = Item::
      whereHas('orderitems', function($q) use ($from,$to) 
{
    //   foreach($q as $orderitem){
    //             if($orderitem->order){
    //                 if($orderitem->order->status == 1){
    //                     $number += $orderitem->quantity; 
    //                 }
    //             }
    //         }
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('seller', function($q) use ($zone_id) 
{
    $q->whereHas("address", function($q1) use ($zone_id) {
    $q1->where('zone_id', '=', $zone_id);
});
})->take('10')->get()->sortByDesc("count_number");
// ->with("orderitems") > 0){

        $names4 =[];
  $numbers4=[];
  foreach($items as $item){
      $names4[]= $item->title;
     
      $number =0;
                   foreach($item->orderitems as $orderitem){
                if($orderitem->order){
                    if($orderitem->order->status == 1){
                        $number += $orderitem->quantity; 
                    }
                }
            }
         $numbers4[]=$number;
  }
       $employees = Employee::withCount("acceptorders")->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($zone_id) 
{
    $q->where("zone_id",$zone_id);

})->take('10')->get()->sortBy('time_accept');
        $names13 =[];
   $numbers13=[];
   foreach($employees as $employee){
       $names13[]= $employee->name;
       $numbers13[]=$employee->time_accept;
   }
    }
    else if($request->country_id && $request->state_id  &&  $request->city_id){
        $city_id = $request->city_id;
        $employees = Employee::withCount("acceptorders")->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($city_id) 
{
    $q->where("city_id",$city_id);

})->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->take('10')->get()->sortBy('time_accept');
        $names13 =[];
   $numbers13=[];
   foreach($employees as $employee){
       $names13[]= $employee->name;
       $numbers13[]=$employee->time_accept;
   }
             $sellers1 = Seller::withCount("items")->orderByDesc('items_count')
             ->whereHas('items', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($city_id) 
{
    $q->where("city_id",$city_id);

})->take('10')->get();
        $names1 =[];
   $numbers1=[];
   foreach($sellers1 as $seller){
       $names1[]= $seller->name;
       $numbers1[]=$seller->items_count;
   }
  $sellers2 = Seller::withCount("acceptorders")->with("acceptorders")->orderByDesc('acceptorders_count')
  ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($city_id) 
{
   $q->where("city_id",$city_id);

})->take('10')->get();
        $names2 =[];
  $numbers2=[];
  foreach($sellers2 as $seller){
      $names2[]= $seller->name;
      $numbers2[]=$seller->acceptorders_count;
  }
       $drivers = Driver::withCount("acceptorders")->orderByDesc('acceptorders_count')
      ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($city_id) 
{
     $q->where("city_id",$city_id);

})->take('10')->get();
        $names3 =[];
  $numbers3=[];
  foreach($drivers as $driver){
      $names3[]= $driver->name;
      $numbers3[]=$driver->acceptorders_count;
  } 
$items = Item::
      whereHas('orderitems', function($q) use ($from,$to) 
{
    //   foreach($q as $orderitem){
    //             if($orderitem->order){
    //                 if($orderitem->order->status == 1){
    //                     $number += $orderitem->quantity; 
    //                 }
    //             }
    //         }
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('seller', function($q) use ($city_id) 
{
    $q->whereHas("address", function($q1) use ($city_id) {
     $q1->where("city_id",$city_id);
});
})->take('10')->get()->sortByDesc("count_number");
// ->with("orderitems") > 0){

        $names4 =[];
  $numbers4=[];
  foreach($items as $item){
      $names4[]= $item->title;
     
      $number =0;
                   foreach($item->orderitems as $orderitem){
                if($orderitem->order){
                    if($orderitem->order->status == 1){
                        $number += $orderitem->quantity; 
                    }
                }
            }
         $numbers4[]=$number;
  }
    }
        else if($request->country_id && $request->state_id){
        $state_id = $request->state_id;
                   $employees = Employee::withCount("acceptorders")->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($state_id) 
{
    $q->where("state_id",$state_id);

})->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->take('10')->get()->sortBy('time_accept');
        $names13 =[];
   $numbers13=[];
   foreach($employees as $employee){
       $names13[]= $employee->name;
       $numbers13[]=$employee->time_accept;
   }
             $sellers1 = Seller::withCount("items")->orderByDesc('items_count')
             ->whereHas('items', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($state_id) 
{
    $q->where("state_id",$state_id);

})->take('10')->get();
        $names1 =[];
   $numbers1=[];
   foreach($sellers1 as $seller){
       $names1[]= $seller->name;
       $numbers1[]=$seller->items_count;
   }
  $sellers2 = Seller::withCount("acceptorders")->with("acceptorders")->orderByDesc('acceptorders_count')
  ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($state_id) 
{
    $q->where("state_id",$state_id);

})->take('10')->get();
        $names2 =[];
  $numbers2=[];
  foreach($sellers2 as $seller){
      $names2[]= $seller->name;
      $numbers2[]=$seller->acceptorders_count;
  }
       $drivers = Driver::withCount("acceptorders")->orderByDesc('acceptorders_count')
      ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($state_id) 
{
    $q->where("state_id",$state_id);

})->take('10')->get();
        $names3 =[];
  $numbers3=[];
  foreach($drivers as $driver){
      $names3[]= $driver->name;
      $numbers3[]=$driver->acceptorders_count;
  } 
$items = Item::
      whereHas('orderitems', function($q) use ($from,$to) 
{
    //   foreach($q as $orderitem){
    //             if($orderitem->order){
    //                 if($orderitem->order->status == 1){
    //                     $number += $orderitem->quantity; 
    //                 }
    //             }
    //         }
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('seller', function($q) use ($state_id) 
{
    $q->whereHas("address", function($q1) use ($state_id) {
  $q1->where("state_id",$state_id);
});
})->take('10')->get()->sortByDesc("count_number");
// ->with("orderitems") > 0){

        $names4 =[];
  $numbers4=[];
  foreach($items as $item){
      $names4[]= $item->title;
     
      $number =0;
                   foreach($item->orderitems as $orderitem){
                if($orderitem->order){
                    if($orderitem->order->status == 1){
                        $number += $orderitem->quantity; 
                    }
                }
            }
         $numbers4[]=$number;
  }
    }
       else if($request->country_id){
        $country_id = $request->country_id;
               $employees = Employee::withCount("acceptorders")->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($country_id) 
{
    $q->where("country_id",$country_id);

})->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->take('10')->get()->sortBy('time_accept');
        $names13 =[];
   $numbers13=[];
   foreach($employees as $employee){
       $names13[]= $employee->name;
       $numbers13[]=$employee->time_accept;
   }
             $sellers1 = Seller::withCount("items")->orderByDesc('items_count')
             ->whereHas('items', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($country_id) 
{
    $q->where("country_id",$country_id);

})->take('10')->get();
        $names1 =[];
   $numbers1=[];
   foreach($sellers1 as $seller){
       $names1[]= $seller->name;
       $numbers1[]=$seller->items_count;
   }
  $sellers2 = Seller::withCount("acceptorders")->with("acceptorders")->orderByDesc('acceptorders_count')
  ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($country_id) 
{
   $q->where("country_id",$country_id);

})->take('10')->get();
        $names2 =[];
  $numbers2=[];
  foreach($sellers2 as $seller){
      $names2[]= $seller->name;
      $numbers2[]=$seller->acceptorders_count;
  }
       $drivers = Driver::withCount("acceptorders")->orderByDesc('acceptorders_count')
      ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($country_id) 
{
   $q->where("country_id",$country_id);

})->take('10')->get();
        $names3 =[];
  $numbers3=[];
  foreach($drivers as $driver){
      $names3[]= $driver->name;
      $numbers3[]=$driver->acceptorders_count;
  } 
$items = Item::
      whereHas('orderitems', function($q) use ($from,$to) 
{
    //   foreach($q as $orderitem){
    //             if($orderitem->order){
    //                 if($orderitem->order->status == 1){
    //                     $number += $orderitem->quantity; 
    //                 }
    //             }
    //         }
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('seller', function($q) use ($country_id) 
{
    $q->whereHas("address", function($q1) use ($country_id) {
  $q1->where("country_id",$country_id);
});
})->take('10')->get()->sortByDesc("count_number");
// ->with("orderitems") > 0){

        $names4 =[];
  $numbers4=[];
  foreach($items as $item){
      $names4[]= $item->title;
     
      $number =0;
                   foreach($item->orderitems as $orderitem){
                if($orderitem->order){
                    if($orderitem->order->status == 1){
                        $number += $orderitem->quantity; 
                    }
                }
            }
         $numbers4[]=$number;
  }
    }
    else{
     
             $sellers1 = Seller::withCount("items")->orderByDesc('items_count')
             ->whereHas('items', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->whereHas('address', function($q) use ($zone_ids) 
{
    $q->whereIn("zone_id",$zone_ids);

})->take('10')->get();
        $names1 =[];
   $numbers1=[];
   foreach($sellers1 as $seller){
       $names1[]= $seller->name;
       $numbers1[]=$seller->items_count;
   }
  $sellers2 = Seller::withCount("acceptorders")->with("acceptorders")->orderByDesc('acceptorders_count')
  ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names2 =[];
  $numbers2=[];
  foreach($sellers2 as $seller){
      $names2[]= $seller->name;
      $numbers2[]=$seller->acceptorders_count;
  }
       $drivers = Driver::withCount("acceptorders")->orderByDesc('acceptorders_count')
      ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names3 =[];
  $numbers3=[];
  foreach($drivers as $driver){
      $names3[]= $driver->name;
      $numbers3[]=$driver->acceptorders_count;
  } 
$items = Item::
      whereHas('orderitems', function($q) use ($from,$to) 
{
    //   foreach($q as $orderitem){
    //             if($orderitem->order){
    //                 if($orderitem->order->status == 1){
    //                     $number += $orderitem->quantity; 
    //                 }
    //             }
    //         }
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get()->sortByDesc("count_number");
// ->with("orderitems") > 0){

        $names4 =[];
  $numbers4=[];
  foreach($items as $item){
      $names4[]= $item->title;
     
      $number =0;
                   foreach($item->orderitems as $orderitem){
                if($orderitem->order){
                    if($orderitem->order->status == 1){
                        $number += $orderitem->quantity; 
                    }
                }
            }
         $numbers4[]=$number;
  }
       $employees = Employee::withCount("acceptorders")->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get()->sortBy('time_accept');
        $names13 =[];
   $numbers13=[];
   foreach($employees as $employee){
       $names13[]= $employee->name;
       $numbers13[]=$employee->time_accept;
       
   }
   
    }
  
          $countries = Country::withCount("acceptorders")->orderByDesc('acceptorders_count')->take('10')->get();
        $names5 =[];
   $numbers5=[];
   foreach($countries as $country){
       $names5[]= $country->name;
       $numbers5[]=$country->acceptorders_count;
   }
          $countries = Country::withCount("acceptorders")->orderByDesc('acceptorders_count')
           ->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names6 =[];
   $numbers6=[];
   foreach($countries as $country){
       $names6[]= $country->name;
         $number =0;
                   foreach($country->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
              $numbers6[]=$number;
   }
       
          $states = State::withCount("acceptorders")->orderByDesc('acceptorders_count')->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names7 =[];
   $numbers7=[];
   foreach($states as $state){
       $names7[]= $state->name;
       $numbers7[]=$state->acceptorders_count;
   }
          $states = State::withCount("acceptorders")->orderByDesc('acceptorders_count')->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names8 =[];
   $numbers8=[];
   foreach($states as $state){
       $names8[]= $state->name;
         $number =0;
                   foreach($state->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers8[]=$number;
   }
          $cities = City::withCount("acceptorders")->orderByDesc('acceptorders_count')->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names9 =[];
   $numbers9=[];
   foreach($cities as $city){
       $names9[]= $city->name;
       $numbers9[]=$city->acceptorders_count;
   }
          $cities = City::withCount("acceptorders")->orderByDesc('acceptorders_count')->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names10 =[];
   $numbers10=[];
   foreach($cities as $city){
       $names10[]= $city->name;
         $number =0;
                   foreach($city->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers10[]=$number;
   }
          $zones = Zone::withCount("acceptorders")->orderByDesc('acceptorders_count')->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names11 =[];
   $numbers11=[];
   foreach($zones as $zone){
       $names11[]= $zone->name;
       $numbers11[]=$zone->acceptorders_count;
   }
            $zones = Zone::withCount("acceptorders")->orderByDesc('acceptorders_count')->whereHas('acceptorders', function($q) use ($from,$to) 
{
    $q->whereBetween("created_at",[$from,$to]);

})->take('10')->get();
        $names12 =[];
   $numbers12=[];
   foreach($zones as $zone){
       $names12[]= $zone->name;
         $number =0;
                   foreach($zone->acceptorders as $order){
               
                        $number += $orderitem->priceafterdiscount; 
                   
                
            }
         $numbers12[]=$number;
   }
  return response()->json(["status" => true,
   "data"=>[
       'names1'=> $names1,'numbers1' => $numbers1,
       //'names2'=> $names2,'numbers2' => $numbers2 ,
       'names3'=> $names3,'numbers3' => $numbers3
       ,'names4'=> $names4,'numbers4' => $numbers4
       ,'names5'=> $names5,'numbers5' => $numbers5
       ,'names6'=> $names6,'numbers6' => $numbers6
       ,'names7'=> $names7,'numbers7' => $numbers7
       ,'names8'=> $names8,'numbers8' => $numbers8
       ,'names9'=> $names9,'numbers9' => $numbers9
       ,'names10'=> $names10,'numbers10' => $numbers10
       ,'names11'=> $names11,'numbers11' => $numbers11
        ,'names12'=> $names12,'numbers12' => $numbers12
         ,'names13'=> $names13,'numbers13' => $numbers13
       ]]);
 
    }  public function countrystatistic(){
    
        return view("admindashboard.statistic.countrystatistic");
    }    public function employeestatistic(){
           $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return view("admindashboard.statistic.employeestatistic",['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    }
}