<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefusedReason;
use App\DataTables\RefusedReasonDataTable;
class RefusedReasonController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(RefusedReasonDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.refusedreasons.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.refusedreasons.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'text' => 'required'],[
      'text.required' => 'هذا الحقل مطلوب'
       ]);
    $reason = new RefusedReason;
    $reason->text = $request->text;
    $reason->save();
    return redirect()->route('refusedreasons.index');
  }

 
  public function edit($id)
  {
    $reason = RefusedReason::where('id',$id)->first();
    return view('admindashboard.refusedreasons.edit')->with('reason',$reason); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'text' => 'required'],[
      'text.required' => 'هذا الحقل مطلوب'
       ]);
   $reason = RefusedReason::where('id',$id)->first();
   $reason->text = $request->text;
    $reason->save();
    return redirect()->route('refusedreasons.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
   $reason = RefusedReason::where('id',$id)->first();
     $reason->delete();
     return response()->json(['status' => true]);
  }
}
