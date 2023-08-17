<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppStatus;
class AppStatusController extends Controller 
{


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit()
  {
       $app_status = AppStatus::firstOrNew();

    return view('admindashboard.app_status.edit')->with('app_status',$app_status);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
     $app_status = AppStatus::first();
   $app_status->message = $request->message;
   if($request->status == 1){
       $app_status->status = 1;
   }else{
         $app_status->status = 0;
   }
     $app_status->save();
   
   return redirect()->back()->with(['success'=> "تم الحفظ بنجاح"]);
  }

  
 
}

?>