<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicletypes;
use App\DataTables\VehicletypesDataTable;
class VehicletypesController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
public function index(VehicletypesDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.vehicletypes.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.vehicletypes.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $type = new Vehicletypes;
    $type->title = $request->title;
    $type->save();
    return redirect()->route('vehicletypes.index');
  }

 
  public function edit($id)
  {
    $type = Vehicletypes::where('id',$id)->first();
    return view('admindashboard.vehicletypes.edit')->with('type',$type); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $type = Vehicletypes::where('id',$id)->first();
    $type->title = $request->title;
    $type->save();
    return redirect()->route('vehicletypes.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $type = Vehicletypes::where('id',$id)->first();
     $type->delete();
     return response()->json(['status' => true]);
  }
  
}

?>