<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\DataTables\UserOrderDataTable;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\User;
class UserController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
          public function index(UserDataTable $dataTable)
            {
                 $countries = Country::all();
            $states = State::all();
            $cities = City::all();
            $zones = Zone::all();
                return $dataTable->render('admindashboard.users.index',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
            }
            
         public function user_orders(UserOrderDataTable $dataTable,$id)
            {
                $dataTable->id = $id;
                return $dataTable->render('admindashboard.users.orders');
            }
  public function user_profile(UserOrderDataTable $dataTable,$id)
            {
               $user = User::Where("id",$id)->first();
               $dataTable->id = $id;
                return $dataTable->render('admindashboard.users.profile',["user" =>$user]);
            }

  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
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
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  public function block_user($id){
      $user = User::where("id",$id)->first();
      $user->block = !$user->block;
      $user->save();
      return response()->json(['status' => true]);
  }
}

?>