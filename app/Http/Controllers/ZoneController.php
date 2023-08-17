<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\Zone;
use App\DataTables\ZoneDataTable;
use App\Models\ZoneLatlon;
use App\Models\ZonePrice;

class ZoneController extends Controller 
{

  
      public function index(ZoneDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.zones.index');
    
  }

 
  public function create()
  {
        $countries = Country::all();
    $states = State::all(); 
     $cities = City::all(); 
    return view('admindashboard.zones.create',compact("countries","states","cities"));
  }

  
  public function store(Request $request)
  {
        $request->validate([
      'name' => 'required',
      'points' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب',
      'points.required' => 'من فضلك اختر منطقه على الخريطه'
       ]);
    $zone = new Zone;
    $zone->name = $request->name;
    $zone->country_id = $request->country_id;
    $zone->state_id = $request->state_id;
     $zone->city_id = $request->city_id;
     $zone->text = $request->points;
     $zone->automatic = $request->automatic ? 1 : 0;
    $zone->save();
    
    
    if($request->points){
         foreach(json_decode($request->points) as $point){
        $area = new ZoneLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->zone_id = $zone->id;
        $area->save();
       }
    }
      if($request->price){
    foreach($request->price as $key => $price){
        $zone_price = new ZonePrice;
        $zone_price->price = $price;
        $zone_price->from_distance = $request->from_distance[$key];
        $zone_price->to_distance = $request->to_distance[$key];
        $zone_price->zone_id = $zone->id;
        $zone_price->save();
    }
}
    return redirect()->route('zone.index');
  }
  public function edit($id)
  {
        $countries = Country::all();
    $states = State::all(); 
     $cities = City::all(); 
     $zone = Zone::where('id',$id)->first();
    return view('admindashboard.zones.edit',compact("countries","states","cities","zone"));
  }
  public function update($id,Request $request)
  {
     $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
       
    $zone = Zone::where('id',$id)->first();
    $zone->name = $request->name;
    $zone->country_id = $request->country_id;
    $zone->state_id = $request->state_id;
     $zone->city_id = $request->city_id;
    $zone->lat = $request->lat;
    if($request->points){
     $zone->text = $request->points;
    }
    $zone->lon = $request->lon;
   $zone->automatic = $request->automatic ? 1 : 0;
    $zone->save();
    if($request->points){
            ZoneLatlon::where('zone_id',$id)->delete();
          foreach(json_decode($request->points) as $point){
         $area = new Zonelatlon;
         $area->lat = $point->lat;
         $area->lon = $point->lng;
         $area->zone_id = $zone->id;
         $area->save();
        }
    }
        ZonePrice::where("zone_id",$zone->id)->delete();

    if($request->price){
    foreach($request->price as $key => $price){
        $zone_price = new ZonePrice;
        $zone_price->price = $price;
        $zone_price->from_distance = $request->from_distance[$key];
        $zone_price->to_distance = $request->to_distance[$key];
        $zone_price->zone_id = $zone->id;
        $zone_price->save();
    }
}
    return redirect()->route('zone.index');
  }

  public function destroy($id)
  {
    $zone = Zone::where('id',$id)->first();
    $zone->delete();
    return response()->json(['status' => true]);
  }
  
}

?>