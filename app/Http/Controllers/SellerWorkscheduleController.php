<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Day;
use App\Models\Workschedule;
use App\DataTables\sellerworkschedulesDataTable;
class SellerWorkscheduleController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(sellerworkschedulesDataTable $dataTable,$id)
  {
      $dataTable->id = $id;
      $seller = Seller::where('id',$id)->first();
    return $dataTable->render('admindashboard.sellerworkschedules.index',['seller' => $seller]);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($id)
  {
    $seller = Seller::where('id',$id)->first();
    $days = Day::all();
    return view('admindashboard.sellerworkschedules.create')->with('seller',$seller)->with('days',$days);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,$id)
  {
    foreach ($request->day_id as $key => $value) {
      $worksc = new Workschedule;
      $worksc->seller_id = $id;
      $worksc->work_from = $request->from[$key];
      $worksc->work_to = $request->to[$key];
      $worksc->day_id = $value;
      $worksc->save();
    }
    return redirect('/indexsellerworkschedule/'.$id);
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
    $sellers = Seller::all();
    $days = Day::all();
    $work =  Workschedule::where('id',$id)->first();
    return view('admindashboard.sellerworkschedules.edit')->with('sellers',$sellers)
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
       return redirect('/indexsellerworkschedule/'.$worksc->seller_id);
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