<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseEmployee;
use App\Models\Employee;
use App\DataTables\ExpenseEmployeeDataTable;
class ExpenseEmployeeController extends Controller
{
      public function index(ExpenseEmployeeDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.expenseemployee.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $employees = Employee::all();
    return view('admindashboard.expenseemployee.create')->with('employees',$employees);
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'value' => 'required'],[
      'value.required' => 'هذا الحقل مطلوب'
       ]);
    $exemployee = new ExpenseEmployee;
    $exemployee->value = $request->value;
     $exemployee->total = $request->total;
       $exemployee->discounts = $request->discounts;
        $exemployee->awards = $request->awards;
     $exemployee->employee_id = $request->employee_id;
    $exemployee->save();
    return redirect()->route('expenseemployee.index');
  }

 
  public function edit($id)
  {
    $exemployee = ExpenseEmployee::where('id',$id)->first();
     $employees = Employee::all();
    return view('admindashboard.expenseemployee.edit')->with('exemployee',$exemployee)->with('employees',$employees); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'value' => 'required'],[
      'value.required' => 'هذا الحقل مطلوب'
       ]);
    $exemployee = ExpenseEmployee::where('id',$id)->first();
       $exemployee->value = $request->value;
     $exemployee->employee_id = $request->employee_id;
    $exemployee->save();
    return redirect()->route('expenseemployee.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $exemployee = ExpenseEmployee::where('id',$id)->first();
     $exemployee->delete();
     return response()->json(['status' => true]);
  }
}
