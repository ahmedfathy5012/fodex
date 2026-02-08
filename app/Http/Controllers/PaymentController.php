<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\DataTables\PaymentDataTable;
class PaymentController extends Controller
{
     public function index(PaymentDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.payments.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.payments.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $payment = new Payment;
    $payment->title = $request->title;
    $payment->save();
    return redirect()->route('payments.index');
  }

 
  public function edit($id)
  {
    $payment = Payment::where('id',$id)->first();
    return view('admindashboard.payments.edit')->with('payment',$payment); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $payment = Payment::where('id',$id)->first();
    $payment->title = $request->title;
    $payment->save();
    return redirect()->route('payments.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $payment = Payment::where('id',$id)->first();
     $payment->delete();
     return response()->json(['status' => true]);
  }
}
