<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use App\traits\generaltrait;
use App\DataTables\MajorDataTable;
use Illuminate\Support\Facades\File; 
class MajorController extends Controller 
{

 use generaltrait;
   public function index(MajorDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.majors.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
 
    return view('admindashboard.majors.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $major = new Major;
    $major->title = $request->title;
    $major->description = $request->description;
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'majors');
            $major->image = $image;
        }
    $major->save();
    return redirect()->route('major.index');
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
    $major = Major::where('id',$id)->first();

    return view('admindashboard.majors.edit')->with('major',$major);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $major = Major::where('id',$id)->first();
    $major->title = $request->title;
    $major->description = $request->description;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$major->image);
            $image = $this->uploadimage($request->image,'majors');
            $major->image = $image;
        }
    $major->save();
    return redirect()->route('major.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $major = Major::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$major->image);
      $major->delete();
      return response()->json(['status' => true]);
  }
  public function major_order(Request $request){
         $major = Major::where('id',$request->major_id)->first();
         $major->order_number = $request->order_number;
         $major->save();
         return response()->json(['status' => true]);
    }
}

?>