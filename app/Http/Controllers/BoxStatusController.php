<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxStatus;
use App\DataTables\BoxStatusDataTable;
class BoxStatusController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(BoxStatusDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.boxstatus.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.boxstatus.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $boxstatus = new BoxStatus;
    $boxstatus->title = $request->title;
    $boxstatus->save();
    return redirect()->route('boxstatus.index');
  }

 
  public function edit($id)
  {
    $boxstatus = BoxStatus::where('id',$id)->first();
    return view('admindashboard.boxstatus.edit')->with('Boxstatus',$boxstatus); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $boxstatus = BoxStatus::where('id',$id)->first();
    $boxstatus->title = $request->title;
    $boxstatus->save();
    return redirect()->route('boxstatus.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $boxstatus = BoxStatus::where('id',$id)->first();
     $boxstatus->delete();
     return response()->json(['status' => true]);
  }
  
}

?>