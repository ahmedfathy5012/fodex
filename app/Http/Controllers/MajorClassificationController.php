<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorClassification;
use App\Models\Seller;
use App\Models\Major;
use App\Models\Zone;
use App\traits\generaltrait;
use App\Models\HomecontentSeller;
use App\Models\MajorClassificationSeller;
use App\DataTables\MajorClassificationDataTable;
use Illuminate\Support\Facades\File; 
use App\DataTables\SellerClassDataTable;
class MajorClassificationController extends Controller
{
    use generaltrait;
   public function index(MajorClassificationDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.majorclassification.index');
    
  }


  public function create()
  {
 $sellers = Seller::all();
  $majors = Major::all();
   $zones = Zone::all();
    return view('admindashboard.majorclassification.create')->with('sellers',$sellers)->with('majors',$majors)->with("zones",$zones);
  }



  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = new MajorClassification;
    $home->title = $request->title;
      $home->major_id = $request->major_id;
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'majorclassification');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->attach($request->seller_id);
    $home->zones()->attach($request->zone_id);
    return redirect()->route('majorclassification.index');
  }


  public function show($id)
  {
    
  }

  public function edit($id)
  {
    $home = MajorClassification::where('id',$id)->first();
 $sellers = Seller::all();
  $majors = Major::all();
  $zones = Zone::all();
    return view('admindashboard.majorclassification.edit')->with('sellers',$sellers)->with('home',$home)->with('majors',$majors)->with("zones",$zones);
  }


  public function update($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = MajorClassification::where('id',$id)->first();
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$home->image);
            $image = $this->uploadimage($request->image,'majorclassification');
            $home->image = $image;
        }
          $home->major_id = $request->major_id;
    $home->save();
    $home->sellers()->sync($request->seller_id);
    $home->zones()->sync($request->zone_id);
    return redirect()->route('majorclassification.index');
  }
  public function destroy($id)
  {
   $home = MajorClassification::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$home->image);
      $home->delete();
      return response()->json(['status' => true]);
  }  public function sellersclass(SellerClassDataTable $dataTable,$id)
    {
         $home = MajorClassification::where('id',$id)->first();
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.majorclassification.sellers',['home' =>$home,'id' => $id]);
    
  }  public function addsellerclass($id)
  {
    $home = MajorClassification::where('id',$id)->first();
$sellers = Seller::all();
    return view('admindashboard.majorclassification.addseller')->with('sellers',$sellers)->with('home',$home);
  } public function updateclassseller($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = MajorClassification::where('id',$id)->first();
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$home->image);
            $image = $this->uploadimage($request->image,'majorclassification');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->sync($request->seller_id);
    return redirect('sellersclass/'.$id);
  }public function deletesellerclass($id){
      $homeseller =MajorClassificationSeller::where('id',$id)->first();
      $homeseller->delete();
      return response()->json(['status' => true]);
  }
public function order_numbersellerclass(Request $request){
         $res = MajorClassificationSeller::where('id',$request->id)->first();
         $res->order_number = $request->order_number;
         $res->save();
         return response()->json(['status' => true]);
    }public function order_numbersellerclass1(Request $request){
         $res = MajorClassification::where('id',$request->id)->first();
         $res->order_number = $request->order_number;
         $res->save();
         return response()->json(['status' => true]);
    }
}
