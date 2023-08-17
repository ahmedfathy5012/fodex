<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus;
use App\DataTables\OrderStatusDataTable;
class OrderStatusController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(OrderStatusDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.orderstatus.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.orderstatus.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $orderstatus = new OrderStatus;
    $orderstatus->title = $request->title;
    $orderstatus->save();
    return redirect()->route('orderstatus.index');
  }

 
  public function edit($id)
  {
    $orderstatus = OrderStatus::where('id',$id)->first();
    return view('admindashboard.orderstatus.edit')->with('orderstatus',$orderstatus); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $orderstatus = OrderStatus::where('id',$id)->first();
    $orderstatus->title = $request->title;
    $orderstatus->save();
    return redirect()->route('orderstatus.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $orderstatus = OrderStatus::where('id',$id)->first();
     $orderstatus->delete();
     return response()->json(['status' => true]);
  }
  
}

?>