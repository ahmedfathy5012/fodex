<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\DeliveryArea;
use App\Models\DeliveryAreaLatlon;

use App\DataTables\DeliveryAreaDataTable;
class DeliveryAreaController extends Controller 
{

  
      public function index(DeliveryAreaDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.delivery_areas.index');
    
  }

 
  public function create()
  {
        $countries = Country::all();
    $states = State::all(); 
     $cities = City::all(); 
    return view('admindashboard.delivery_areas.create',compact("countries","states","cities"));
  }

  
  public function store(Request $request)
  {
        $request->validate([
      'name' => 'required',
      'points' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب',
      'points.required' => 'من فضلك اختر منطقه على الخريطه'
       ]);
    $delivery_area = new DeliveryArea;
    $delivery_area->name = $request->name;
    $delivery_area->country_id = $request->country_id;
    $delivery_area->state_id = $request->state_id;
     $delivery_area->city_id = $request->city_id;
     $delivery_area->text = $request->points;
      $delivery_area->price = $request->price;
    $delivery_area->save();
//   if($request->price){
//     foreach($request->price as $key => $price){
//         $del_price = new DeliveryAreaPrice;
//         $del_price->price = $price;
//         $del_price->from_distance = $request->from_distance[$key];
//         $del_price->to_distance = $request->to_distance[$key];
//         $del_price->delivery_area_id = $delivery_area->id;
//         $del_price->save();
//     }
// }
  if($request->points){
         foreach(json_decode($request->points) as $point){
        $area = new DeliveryAreaLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->delivery_area_id = $delivery_area->id;
        $area->save();
       }
    }
    return redirect()->route('delivery_areas.index');
  }
  public function edit($id)
  {
        $countries = Country::all();
    $states = State::all(); 
     $cities = City::all(); 
     $delivery_area = DeliveryArea::where('id',$id)->first();
    return view('admindashboard.delivery_areas.edit',compact("countries","states","cities","delivery_area"));
  }
  public function update($id,Request $request)
  {
     $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
      
    $delivery_area = DeliveryArea::where('id',$id)->first();
    $delivery_area->name = $request->name;
    $delivery_area->country_id = $request->country_id;
    $delivery_area->state_id = $request->state_id;
     $delivery_area->city_id = $request->city_id;
    $delivery_area->lat = $request->lat;
    if($request->points){
     $delivery_area->text = $request->points;
    }
    $delivery_area->lon = $request->lon;
          $delivery_area->price = $request->price;

    $delivery_area->save();
// if($request->price){
//     DeliveryAreaPrice::where("delivery_area_id",$delivery_area->id)->delete();
//     foreach($request->price as $key => $price){
//         $del_price = new DeliveryAreaPrice;
//         $del_price->price = $price;
//         $del_price->from_distance = $request->from_distance[$key];
//         $del_price->to_distance = $request->to_distance[$key];
//         $del_price->delivery_area_id = $delivery_area->id;
//         $del_price->save();
//     }
// }
    if($request->points){
            DeliveryAreaLatlon::where('delivery_area_id',$id)->delete();
          foreach(json_decode($request->points) as $point){
         $area = new DeliveryAreaLatlon;
         $area->lat = $point->lat;
         $area->lon = $point->lng;
         $area->delivery_area_id = $delivery_area->id;
         $area->save();
        }
    }
    
    return redirect()->route('delivery_areas.index');
  }

  public function destroy($id)
  {
    $delivery_area = DeliveryArea::where('id',$id)->first();
    $delivery_area->delete();
    return response()->json(['status' => true]);
  }
  
}

?>