<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorOffer;
use App\traits\generaltrait;
use App\DataTables\MajorOfferDataTable;
use Illuminate\Support\Facades\File; 
use App\Models\Seller;

class MajorOfferController extends Controller
{
   use generaltrait;
   public function index(MajorOfferDataTable $dataTable,$id)
    {
        $dataTable->id = $id;

        return $dataTable->render('admindashboard.majors.offers.index',['id' => $id]);
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($id)
  {
// dd("create");
   $sellers = Seller::select("id","name")->get();

    return view('admindashboard.majors.offers.create',compact("sellers"))->with('id',$id);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,$id)
  {
    $request->validate([
    //  'title' => 'required'
      ],[
     // 'title.required' => 'هذا الحقل مطلوب'
       ]);
    $offer = new MajorOffer;

     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'offers');
            $offer->image = $image;
        }
         $offer->seller_id = $request->seller_id;
        $offer->major_id = $id;
    $offer->save();
    return redirect('majorsoffers/'.$offer->major_id);
  }


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
    $offer = MajorOffer::where('id',$id)->first();
   $sellers = Seller::select("id","name")->get();

    return view('admindashboard.majors.offers.edit',compact("sellers","offer"));
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
      
      ],[
     
       ]);
    $offer = MajorOffer::where('id',$id)->first();
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$major->image);
            $image = $this->uploadimage($request->image,'majors');
            $offer->image = $image;
        }
         $offer->seller_id = $request->seller_id;
    $offer->save();
   return redirect('majorsoffers/'.$offer->major_id);
  }


  public function destroy($id)
  {
    $offer = MajorOffer::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$offer->image);
      $offer->delete();
      return response()->json(['status' => true]);
  }
  
}
