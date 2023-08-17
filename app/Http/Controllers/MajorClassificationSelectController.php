<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorClassification;
use App\Models\MajorClassificationSelect;
use App\Models\Seller;
use App\Models\Major;
use App\traits\generaltrait;
use App\Models\HomecontentSeller;
use App\Models\MajorClassificationSeller;
use App\DataTables\MajorClassificationDataTable;
use Illuminate\Support\Facades\File; 
use App\DataTables\MajorClassificationSelectDataTable;
class MajorClassificationSelectController extends Controller
{
    use generaltrait;
   public function index(MajorClassificationSelectDataTable $dataTable,$id)
    {
        $dataTable->id = $id;

        return $dataTable->render('admindashboard.majorclassification.indexselect',['id' => $id]);
    
  }


  public function create($id)
  {
 $sellers = Seller::all();
  $majors = Major::all();
    return view('admindashboard.majorclassification.createselect')->with('sellers',$sellers)->with('majors',$majors)->with('id',$id);
  }



  public function store(Request $request,$id)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
     //  dd($request->all());
    
    $home = new MajorClassificationSelect;
    $home->title = explode(" - ",$request->title)[0];
      $home->majorclassification_id = $id;
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'majorclassification');
            $home->image = $image;
        }
      
         $home->status = explode(" - ",$request->title)[1];
    $home->save();
    return redirect('majorclassificationselect/'.$home->majorclassification_id);
  }


  public function show($id)
  {
    
  }

  public function edit($id)
  {
    $home = MajorClassificationSelect::where('id',$id)->first();
 $sellers = Seller::all();
  $majors = Major::all();
    return view('admindashboard.majorclassification.editselect')->with('sellers',$sellers)->with('home',$home)->with('majors',$majors);
  }


  public function update($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = MajorClassificationSelect::where('id',$id)->first();
  $home->title = explode(" - ",$request->title)[0];
     
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'majorclassification');
            $home->image = $image;
        }
      
         $home->status = explode(" - ",$request->title)[1];
    $home->save();
     return redirect('majorclassificationselect/'.$home->majorclassification_id);
  }
  public function destroy($id)
  {
   $home = MajorClassificationSelect::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$home->image);
      $home->delete();
      return response()->json(['status' => true]);
  }  public function sellersclass(SellerClassDataTable $dataTable,$id)
    {
         $home = MajorClassification::where('id',$id)->first();
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.majorclassification.sellers',['home' =>$home]);
    
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
