<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\ExpenseDriver;
use App\DataTables\ExpenseDriverDataTable;
use App\DataTables\AllCollectionDataTable;
class ExpenseDriverController extends Controller
{
   public function index(ExpenseDriverDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.expensedriver.index');
    
  }public function allcollections(AllCollectionDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.expenses.allcollections');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $drivers = Driver::all();
    return view('admindashboard.expensedriver.create')->with('drivers',$drivers);
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'value' => 'required'],[
      'value.required' => 'هذا الحقل مطلوب'
       ]);
    $exdriver = new ExpenseDriver;
    $exdriver->value = $request->value;
      $exdriver->total = $request->total;
       $exdriver->discounts = $request->discounts;
        $exdriver->awards = $request->awards;
     $exdriver->driver_id = $request->driver_id;
    $exdriver->save();
    return redirect()->route('expensedriver.index');
  }

 
  public function edit($id)
  {
    $exdriver = ExpenseDriver::where('id',$id)->first();
     $drivers = Driver::all();
    return view('admindashboard.expensedriver.edit')->with('exdriver',$exdriver)->with('drivers',$drivers); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'value' => 'required'],[
      'value.required' => 'هذا الحقل مطلوب'
       ]);
    $exdriver = ExpenseDriver::where('id',$id)->first();
       $exdriver->value = $request->value;
         $exdriver->total = $request->total;
       $exdriver->discounts = $request->discounts;
        $exdriver->awards = $request->awards;
     $exdriver->driver_id = $request->driver_id;
    $exdriver->save();
    return redirect()->route('expensedriver.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $exdriver = ExpenseDriver::where('id',$id)->first();
     $exdriver->delete();
     return response()->json(['status' => true]);
  }
}
