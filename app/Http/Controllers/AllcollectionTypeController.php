<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllcollectionType;
use App\DataTables\AllcollectionTypeDataTable;
class AllcollectionTypeController extends Controller
{
   public function index(AllcollectionTypeDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.collectionstypes.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.collectionstypes.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
    $collect = new AllcollectionType;
    $collect->name = $request->name;
     $collect->value = $request->value;
    $collect->save();
    return redirect()->route('collectionstypes.index');
  }

 
  public function edit($id)
  {
    $collect = AllcollectionType::where('id',$id)->first();
    return view('admindashboard.collectionstypes.edit')->with('collect',$collect); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'name' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
    $collect = AllcollectionType::where('id',$id)->first();
    $collect->name = $request->name;
      $collect->value = $request->value;
    $collect->save();
    return redirect()->route('collectionstypes.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $collect = AllcollectionType::where('id',$id)->first();
     $collect->delete();
     return response()->json(['status' => true]);
  }
}
