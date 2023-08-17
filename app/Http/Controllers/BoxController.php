<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoxStatus;
use App\Models\Box;
use App\DataTables\BoxDataTable;
class BoxController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(BoxDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.boxs.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      $boxstatus = BoxStatus::all();
    return view('admindashboard.boxs.create')->with("boxstatus",$boxstatus);
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $box = new Box;
    $box->title = $request->title;
     $box->width = $request->width;
      $box->height = $request->height;
      $box->code = $request->code;
        if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'boxs');
            $box->image = $image;
        }
       $box->boxstatus_id = $request->boxstatus_id;
    $box->save();
    return redirect()->route('boxs.index');
  }

 
  public function edit($id)
  {
    $box = Box::where('id',$id)->first();
    $boxstatus = BoxStatus::all();
    return view('admindashboard.boxs.edit')->with('boxstatus',$boxstatus)->with("box",$box); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $box = Box::where('id',$id)->first();
     $box->title = $request->title;
     $box->width = $request->width;
      $box->height = $request->height;
       $box->boxstatus_id = $request->boxstatus_id;
       $box->code = $request->code;
        if($request->hasFile('image'))
        {
         File::delete(public_path(). '/uploads/'.$box->image);
            $image = $this->uploadimage($request->image,'boxs');
            $box->image = $image;
        }
    $box->save();
    return redirect()->route('boxs.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
         $box = Box::where('id',$id)->first();
     $box->delete();
     return response()->json(['status' => true]);
  }
  
}

?>