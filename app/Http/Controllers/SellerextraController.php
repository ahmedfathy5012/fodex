<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerExtra;
use App\DataTables\SellerExtraDataTable;
class SellerextraController extends Controller 
{

 
 
     public function index(SellerExtraDataTable $dataTable,$id)
    {
     $dataTable->id  = $id;
        return $dataTable->render('admindashboard.seller_extras.index',["id" => $id]);
    }
  


  public function create($id)
  {
     
    return view('admindashboard.seller_extras.create',compact("id"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,$id)
  {
     
    $request->validate([
      'title' => 'required'],[
      'name.required' => 'هذا الحقل مطلوب'
       ]);
    $seller_extra = new SellerExtra;
    $seller_extra->title = $request->title;
    $seller_extra->seller_id = $id;
    $seller_extra->save();
  
    return redirect()->route('seller_extras.index',["id" => $id]);
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
  
    $seller_extra = SellerExtra::where('id',$id)->first();
     return view('admindashboard.seller_extras.edit')->with('seller_extra',$seller_extra);
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
     $seller_extra = SellerExtra::where('id',$id)->first();
     $seller_extra->title = $request->title;
     $seller_extra->save();
   
    return redirect()->route('seller_extras.index',["id" => $seller_extra->seller_id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $seller_extra = SellerExtra::where('id',$id)->first();
     $seller_extra->delete();
     return response()->json(['status' => true]);
  } 
  
}

?>