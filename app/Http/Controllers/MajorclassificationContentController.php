<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\Seller;
use App\traits\generaltrait;
use App\Models\MajorclassificationcontentSeller;
use App\Models\MajorclassificationContent;
use App\DataTables\MajorclassificationContentDataTable;
use Illuminate\Support\Facades\File; 
use App\DataTables\MajorclassificationcontentSellerDataTable;
class MajorclassificationContentController extends Controller
{
    use generaltrait;
   public function index(MajorclassificationContentDataTable $dataTable,$id)
    {
    $dataTable->id = $id;
        return $dataTable->render('admindashboard.majorclassification.homecontent.index',['id' => $id]);
    
  }


  public function create($id)
  {
 $sellers = Seller::all();
    return view('admindashboard.majorclassification.homecontent.create')->with('sellers',$sellers)->with('id',$id);
  }



  public function store(Request $request,$id)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = new MajorclassificationContent;
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'homecontent');
            $home->image = $image;
        }
        $home->majorclassification_id = $id;
    $home->save();
    $home->sellers()->attach($request->seller_id);
    return redirect('majorcontents/'.$id);
  }


  public function show($id)
  {
    
  }

  public function edit($id)
  {
    $home = MajorclassificationContent::where('id',$id)->first();
$sellers = Seller::all();
    return view('admindashboard.majorclassification.homecontent.edit')->with('sellers',$sellers)->with('home',$home);
  }


  public function update($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = MajorclassificationContent::where('id',$id)->first();
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$home->image);
            $image = $this->uploadimage($request->image,'homecontent');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->sync($request->seller_id);
    return redirect('majorcontents/'.$home->majorclassification_id);
  }
  public function destroy($id)
  {
   $home = MajorclassificationContent::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$home->image);
      $home->delete();
      return response()->json(['status' => true]);
  }  public function sellersmajorcontent(MajorclassificationcontentSellerDataTable $dataTable,$id)
    {
         $home = MajorclassificationContent::where('id',$id)->first();
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.majorclassification.homecontent.sellers',['home' =>$home]);
    
  }  public function addsellermajorcontent($id)
  {
    $home = MajorclassificationContent::where('id',$id)->first();
$sellers = Seller::all();
    return view('admindashboard.majorclassification.homecontent.addseller')->with('sellers',$sellers)->with('home',$home);
  } public function updatemajorcontentseller($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = MajorclassificationContent::where('id',$id)->first();
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$home->image);
            $image = $this->uploadimage($request->image,'homecontent');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->sync($request->seller_id);
    return redirect('sellersmajorcontent/'.$id);
  }
//   public function changesellerstatus(Request $request){
//       $homeseller =HomecontentSeller::where('id',$request->id)->first();
//       if($homeseller->status == 1){
//           $homeseller->status = 0;
//       }else{
//       $homeseller->status = 1;
//       }
//       $homeseller->save();
//       return response()->json(['status' => true]);
//   }
  public function deletesellermajorcontent($id){
      $homeseller =MajorclassificationcontentSeller::where('id',$id)->first();
      $homeseller->delete();
      return response()->json(['status' => true]);
  }
public function order_numbersellermajorcontent(Request $request){
         $res = MajorclassificationcontentSeller::where('id',$request->id)->first();
         $res->order_number = $request->order_number;
         $res->save();
         return response()->json(['status' => true]);
    }
}
