<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statussocial;
use App\DataTables\StatussocialDataTable;
class StatussocialsController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(StatussocialDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.statussocials.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.statussocials.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $status = new Statussocial;
    $status->title = $request->title;
    $status->save();
    return redirect()->route('statussocials.index');
  }

 
  public function edit($id)
  {
    $status = Statussocial::where('id',$id)->first();
    return view('admindashboard.statussocials.edit')->with('status',$status); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $status = Statussocial::where('id',$id)->first();
    $status->title = $request->title;
    $status->save();
    return redirect()->route('statussocials.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $status = Statussocial::where('id',$id)->first();
     $status->delete();
     return response()->json(['status' => true]);
  }
  
}

?>