<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Models\City;
use App\Models\CityLatlon;
use App\DataTables\CityDataTable;
use App\DataTables\CityZoneDataTable;
class CityController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
     public function index(CityDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.cities.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $countries = Country::all();
    $states = State::all(); 
    return view('admindashboard.cities.create')->with('countries',$countries)->with('states',$states);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
    $city = new City;
    $city->name = $request->name;
    $city->country_id = $request->country_id;
    $city->state_id = $request->state_id;
    // $city->lat = $request->lat;
    // $city->lon = $request->lon;
     $city->text = $request->points;
    $city->save();
    if($request->points){
         foreach(json_decode($request->points) as $point){
        $area = new CityLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->city_id = $city->id;
        $area->save();
       }
    }
    return redirect()->route('city.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
       $countries = Country::all();
    $states = State::all(); 
    $city = City::where('id',$id)->first();
    return view('admindashboard.cities.edit')->with('countries',$countries)->with('states',$states)->with('city',$city);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id,Request $request)
  {
      $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
    $city = City::where('id',$id)->first();
    $city->name = $request->name;
    $city->country_id = $request->country_id;
    $city->state_id = $request->state_id;
    // $city->lat = $request->lat;
    // $city->lon = $request->lon;
      if($request->points){
    $city->text = $request->points;
      }
    $city->save();
    if($request->points){
         foreach(json_decode($request->points) as $point){
         CityLatlon::where('city_id',$id)->delete();
        $area = new CityLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->city_id = $city->id;
        $area->save();
       }
    }
    return redirect()->route('city.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
        $city = City::where('id',$id)->first();
        $city->delete();
        return response()->json(['status' => true]);
  }public function city_zones(CityZoneDataTable $dataTable,$id)
    {
      $dataTable->id = $id;
        return $dataTable->render('admindashboard.cities.zones.index');
    }
 
}

?>