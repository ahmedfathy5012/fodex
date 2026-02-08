<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\Expense;
use App\DataTables\ExpenseDataTable;
class ExpenseController extends Controller
{
   public function index(ExpenseDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.expenses.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $expenses = ExpenseType::all();
    return view('admindashboard.expenses.create')->with('expenses',$expenses);
  }

 
  public function store(Request $request)
  {
    $extype = new Expense;
    $extype->paid = $request->paid;
     $extype->expensestype_id = $request->expensestype_id;
     $extype->employee_id = auth()->id();
    $extype->save();
    return redirect()->route('expenses.index');
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
     $extype = Expense::where('id',$id)->first();
     $extype->delete();
     return response()->json(['status' => true]);
  }
}
