<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armycase;
use App\DataTables\ArmycaseDataTable;
class ArmycaseController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(ArmycaseDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.armycases.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.armycases.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $army = new Armycase;
    $army->title = $request->title;
    $army->save();
    return redirect()->route('armycase.index');
  }

 
  public function edit($id)
  {
    $army = Armycase::where('id',$id)->first();
    return view('admindashboard.armycases.edit')->with('army',$army); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $army = Armycase::where('id',$id)->first();
    $army->title = $request->title;
    $army->save();
    return redirect()->route('armycase.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $army = Armycase::where('id',$id)->first();
     $army->delete();
     return response()->json(['status' => true]);
  }
  
}

?>