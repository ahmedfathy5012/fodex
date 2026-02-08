<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use App\Models\StateLatlon;
use App\DataTables\StateDataTable;
use App\DataTables\StateCityDataTable;
class StateController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(StateDataTable $dataTable)
  {
 return $dataTable->render('admindashboard.states.index');  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $countries = Country::all();
    return view('admindashboard.states.create')->with('countries',$countries);
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
    $state = new State;
    $state->name = $request->name;
    $state->country_id = $request->country_id;
    $state->lat = $request->lat;
    $state->lon = $request->lon;
   $state->text = $request->points;
    $state->save();
    if($request->points){
         foreach(json_decode($request->points) as $point){
        $area = new StateLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->state_id = $state->id;
        $area->save();
       }
    }
    return redirect()->route('state.index');
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
    $state = State::where('id',$id)->first();
    return view('admindashboard.states.edit')->with('countries',$countries)->with('state',$state);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
      $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
    $state = State::where('id',$id)->first();
    $state->name = $request->name;
    $state->country_id = $request->country_id;
    $state->lat = $request->lat;
    $state->lon = $request->lon;
     if($request->points){
    $state->text = $request->points;
      }
    $state->save();
    if($request->points){
         foreach(json_decode($request->points) as $point){
         StateLatlon::where('state_id',$id)->delete();
        $area = new StateLatlon;
        $area->lat = $point->lat;
        $area->lon = $point->lng;
        $area->state_id = $state->id;
        $area->save();
       }
    }
    return redirect()->route('state.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $state = State::where('id',$id)->first();
    $state->delete();
    return response()->json(['status' => true]);
  }
   public function state_cities(StateCityDataTable $dataTable,$id)
    {
      $dataTable->id = $id;
        return $dataTable->render('admindashboard.states.cities.index');
    }
}

?>