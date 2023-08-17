<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\traits\generaltrait;
use App\DataTables\OfferDataTable;
use Illuminate\Support\Facades\File; 
use App\Models\Zone;
use App\Models\Seller;

class OfferController extends Controller
{
   use generaltrait;
   public function index(OfferDataTable $dataTable)
    {

        return $dataTable->render('admindashboard.offers.index');
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
   $zones = Zone::all();
   $sellers = Seller::select("id","name")->get();
    return view('admindashboard.offers.create',compact("zones","sellers"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $request->validate([
    //  'title' => 'required'
      ],[
     // 'title.required' => 'هذا الحقل مطلوب'
       ]);
    $offer = new Offer;

     if($request->hasFile('image'))
        {
       
            $image = $this->uploadimage($request->image,'offers');
            $offer->image = $image;
        }
       
            $offer->paid = $request->paid ? 1 :0;
           $offer->seller_id = $request->seller_id;

    $offer->save();
     $offer->zones()->attach($request->zone_id);
    return redirect()->route('offers.index');
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
    $offer = Offer::where('id',$id)->first();
 $zones = Zone::all();
    $sellers = Seller::select("id","name")->get();

    return view('admindashboard.offers.edit',compact("zones","offer","sellers"));
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
    $offer = Offer::where('id',$id)->first();
     if($request->hasFile('image'))
        {
              File::delete(public_path(). '/uploads/'.$major->image);
            $image = $this->uploadimage($request->image,'majors');
            $offer->image = $image;
        } 
        
       $offer->paid = $request->paid ? 1 :0;
   $offer->seller_id = $request->seller_id;
    $offer->save();
     $offer->zones()->sync($request->zone_id);
    return redirect()->route('offers.index');
  }


  public function destroy($id)
  {
    $offer = Offer::where('id',$id)->first();
      File::delete(public_path(). '/uploads/'.$offer->image);
      $offer->delete();
      return response()->json(['status' => true]);
  }
  
}
