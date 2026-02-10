<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\DataTables\ExpenseTypeDataTable;

class ExpenseTypeController extends Controller
{
  public function index(ExpenseTypeDataTable $dataTable)
  {

    return $dataTable->render('admindashboard.expensetypes.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.expensetypes.create');
  }


  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required'
    ], [
      'name.required' => 'هذا الحقل مطلوب'
    ]);
    $extype = new ExpenseType;
    $extype->name = $request->name;
    $extype->value = $request->value;
    $extype->save();
    return redirect()->route('expensetype.index');
  }


  public function edit($id)
  {
    $extype = ExpenseType::where('id', $id)->first();
    return view('admindashboard.expensetypes.edit')->with('extype', $extype);
  }
  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required'
    ], [
      'name.required' => 'هذا الحقل مطلوب'
    ]);
    $extype = ExpenseType::where('id', $id)->first();
    $extype->name = $request->name;
    $extype->value = $request->value;
    $extype->save();
    return redirect()->route('expensetype.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $extype = ExpenseType::where('id', $id)->first();
    $extype->delete();
    return response()->json(['status' => true]);
  }
}
