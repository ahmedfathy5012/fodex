<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;
use App\DataTables\GenderDataTable;
class GenderController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(GenderDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.gender.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.gender.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $gender = new Gender;
    $gender->title = $request->title;
    $gender->save();
    return redirect()->route('gender.index');
  }

 
  public function edit($id)
  {
    $gender = Gender::where('id',$id)->first();
    return view('admindashboard.gender.edit')->with('gender',$gender); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $gender = Gender::where('id',$id)->first();
    $gender->title = $request->title;
    $gender->save();
    return redirect()->route('gender.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $gender = Gender::where('id',$id)->first();
     $gender->delete();
     return response()->json(['status' => true]);
  }
  
}

?>