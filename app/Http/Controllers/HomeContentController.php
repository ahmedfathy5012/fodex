<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\Seller;
use App\traits\generaltrait;
use App\Models\HomecontentSeller;
use App\DataTables\HomeContentDataTable;
use Illuminate\Support\Facades\File; 
use App\DataTables\SellerContentDataTable;
use App\Models\Zone;
class HomeContentController extends Controller
{
    use generaltrait;
   public function index(HomeContentDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.homecontent.index');
    
  }


  public function create()
  {
 $sellers = Seller::all();
 $zones = Zone::all();
    return view('admindashboard.homecontent.create',compact("sellers","zones"));
  }



  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = new HomeContent;
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'homecontent');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->attach($request->seller_id);
     $home->zones()->attach($request->zone_id);
    return redirect()->route('homecontent.index');
  }


  public function show($id)
  {
    
  }

  public function edit($id)
  {
    $home = HomeContent::where('id',$id)->first();
$sellers = Seller::all();
 $zones = Zone::all();
    return view('admindashboard.homecontent.edit',compact("sellers","zones","home"));
  }


  public function update($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = HomeContent::where('id',$id)->first();
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$home->image);
            $image = $this->uploadimage($request->image,'homecontent');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->sync($request->seller_id);
       $home->zones()->sync($request->zone_id);
    return redirect()->route('homecontent.index');
  }
  public function destroy($id)
  {
   $home = HomeContent::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$home->image);
      $home->delete();
      return response()->json(['status' => true]);
  }  public function sellerscontent(SellerContentDataTable $dataTable,$id)
    {
         $home = HomeContent::where('id',$id)->first();
        $dataTable->id = $id;
        return $dataTable->render('admindashboard.homecontent.sellers',['home' =>$home]);
    
  }  public function addseller($id)
  {
    $home = HomeContent::where('id',$id)->first();
$sellers = Seller::all();
    return view('admindashboard.homecontent.addseller')->with('sellers',$sellers)->with('home',$home);
  } public function updatehomeseller($id,Request $request)
  {

    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $home = HomeContent::where('id',$id)->first();
    $home->title = $request->title;
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$home->image);
            $image = $this->uploadimage($request->image,'homecontent');
            $home->image = $image;
        }
    $home->save();
    $home->sellers()->sync($request->seller_id);
    return redirect('sellerscontent/'.$id);
  }public function changesellerstatus(Request $request){
      $homeseller =HomecontentSeller::where('id',$request->id)->first();
      if($homeseller->status == 1){
          $homeseller->status = 0;
      }else{
      $homeseller->status = 1;
      }
      $homeseller->save();
      return response()->json(['status' => true]);
  }public function deletesellerhome($id){
      $homeseller =HomecontentSeller::where('id',$id)->first();
      $homeseller->delete();
      return response()->json(['status' => true]);
  }
public function order_numberseller(Request $request){
         $res = HomecontentSeller::where('id',$request->id)->first();
         $res->order_number = $request->order_number;
         $res->save();
         return response()->json(['status' => true]);
    }
}
