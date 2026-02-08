<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Day;
use App\Models\Workschedule;
use App\DataTables\seller2workschedulesDataTable;
class Seller2WorkscheduleController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(seller2workschedulesDataTable $dataTable)
  {
      $dataTable->id = auth()->user()->seller_id;
      $seller = Seller::where('id',auth()->user()->seller_id)->first();
    return $dataTable->render('sellerdashboard.workschedules.index',['seller' => $seller]);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $seller = Seller::where('id',auth()->user()->seller_id)->first();
    $days = Day::all();
    return view('sellerdashboard.workschedules.create')->with('seller',$seller)->with('days',$days);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    foreach ($request->day_id as $key => $value) {
      $worksc = new Workschedule;
      $worksc->seller_id =auth()->user()->seller_id;
      $worksc->work_from = $request->from[$key];
      $worksc->work_to = $request->to[$key];
      $worksc->day_id = $value;
      $worksc->save();
    }
    return redirect()->route("myworkschedule.index");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
   
    $days = Day::all();
    $work =  Workschedule::where('id',$id)->first();
    return view('admindashboard.sellerworkschedules.edit')
    ->with('days',$days)->with('work',$work);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
      $worksc =  Workschedule::where('id',$id)->first();
    //   $worksc->seller_id = $request->seller_id;
      $worksc->work_from = $request->from;
      $worksc->work_to = $request->to;
      $worksc->day_id = $request->day_id;
      $worksc->save();
         return redirect()->route("myworkschedule.index");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $worksc =  Workschedule::where('id',$id)->first();
     $worksc->delete();
     return response()->json(['status' => true]);
  }
  
}

?>