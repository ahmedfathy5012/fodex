<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Driver;
use App\Models\BoxTake;
use App\DataTables\BoxTakeDataTable;
class BoxTakeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(BoxTakeDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.boxtake.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $drivers = Driver::all();
       $boxs = Box::all();
    return view('admindashboard.boxtake.create')->with("boxs",$boxs)->with("drivers",$drivers);
  }

 
  public function store(Request $request)
  {

    $box = new BoxTake;
    $box->driver_id = $request->driver_id;
     $box->box_id = $request->box_id;
      $box->notes = $request->notes;
    $box->save();
    return redirect()->route('boxtake.index');
  }
}