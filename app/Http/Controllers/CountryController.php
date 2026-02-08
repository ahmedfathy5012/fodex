<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Coin;
use App\Models\CountryLatlon;
use App\DataTables\CountryDataTable;
use App\DataTables\CountryStateDataTable;
class CountryController extends Controller 
{

 
 
     public function index(CountryDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.countries.index');
    }
  


  public function create()
  {
      $coins = Coin::all();
    return view('admindashboard.countries.create')->with('coins',$coins);
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
    $country = new Country;
    $country->name = $request->name;
     $country->code = $request->code;
    $country->coin_id = $request->coin_id;
    $country->lat = $request->lat;
    $country->lon = $request->lon;
     $country->text = $request->points;
    $country->save();
    if($request->points){
         foreach(json_decode($request->points) as $point){
        $area = new CountryLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->country_id = $country->id;
        $area->save();
       }
    }
    return redirect()->route('country.index');
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
       $coins = Coin::all();
    $country = Country::where('id',$id)->first();
     return view('admindashboard.countries.edit')->with('country',$country)->with('coins',$coins);
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
     $country = Country::where('id',$id)->first();
    $country->name = $request->name;
    $country->lat = $request->lat;
    $country->lon = $request->lon;
    $country->code = $request->code;
    $country->coin_id = $request->coin_id;
      if($request->points){
    $country->text = $request->points;
      }
    $country->save();
    if($request->points){
         foreach(json_decode($request->points) as $point){
         CountryLatlon::where('country_id',$id)->delete();
        $area = new CountryLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->country_id = $country->id;
        $area->save();
       }
    }
    return redirect()->route('country.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $country = Country::where('id',$id)->first();
     $country->delete();
     return response()->json(['status' => true]);
  }  public function country_states(CountryStateDataTable $dataTable,$id)
    {
      $dataTable->id = $id;
        return $dataTable->render('admindashboard.countries.states.index');
    }
  
}

?>