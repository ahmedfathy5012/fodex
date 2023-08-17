<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\Income;
use App\DataTables\IncomeDataTable;
use App\Models\AllcollectionType;
class IncomeController extends Controller
{
   public function index(IncomeDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.incomes.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $expenses = AllcollectionType::all();
    return view('admindashboard.incomes.create')->with('expenses',$expenses);
  }

 
  public function store(Request $request)
  {
 
    $income = new Income;
    $income->value = $request->value;
    $income->employee_id = auth()->id();
     $income->collectiontype_id = $request->collectiontype_id;
    $income->save();
    return redirect()->route('incomes.index');
  }

 
  public function edit($id)
  {
   
  }
  public function update(Request $request,$id)
  {
 
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $income = Income::where('id',$id)->first();
     $income->delete();
     return response()->json(['status' => true]);
  }
}
