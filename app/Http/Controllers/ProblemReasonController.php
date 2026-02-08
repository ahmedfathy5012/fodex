<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemReason;
use App\DataTables\ProblemReasonDataTable;
class ProblemReasonController extends Controller
{
     public function index(ProblemReasonDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.problem_reasons.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.problem_reasons.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $reason = new ProblemReason;
    $reason->title = $request->title;
    $reason->save();
    return redirect()->route('problem_reasons.index');
  }

 
  public function edit($id)
  {
    $reason = ProblemReason::where('id',$id)->first();
    return view('admindashboard.problem_reasons.edit')->with('reason',$reason); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $reason = ProblemReason::where('id',$id)->first();
    $reason->title = $request->title;
    $reason->save();
    return redirect()->route('problem_reasons.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $reason = ProblemReason::where('id',$id)->first();
     $reason->delete();
     return response()->json(['status' => true]);
  }
}
