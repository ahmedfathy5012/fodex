<?php 

namespace App\Http\Controllers\CompanyDashboard;

use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;

use App\DataTables\companydashboard\DriverDataTable;

use App\Models\Address;
use App\Models\Driver;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\traits\generaltrait;

use App\Http\Controllers\Controller;

class DriverController extends Controller 
{
use generaltrait;

      protected $view = 'companydashboard.drivers.';
     protected $route = 'company_captions.';
 
  public function index(DriverDataTable $dataTable)
    {
        return $dataTable->render($this->view .'index');
    
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
    return view($this->view .'create')->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
     $request->validate(['phone' => 'required|unique:drivers']);
    $driver = Driver::create([
        "name" => $request->name,
         "phone" => $request->phone,
          "mobile" => $request->mobile,

           "driver_id" => auth()->id(),
           "is_company" => 0,
      "password" =>  Hash::make($request->phone)
        ]);
    
        $address = new Address;
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
         $address->street = $request->street;
         $address->driver_id = $driver->id;
     
       return redirect()->route($this->route."index")
        ->with(['success'=> "تم الاضافه بنجاح"]);

  }

 
  public function edit($id)
  {
  
    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
      $driver = Driver::where('id',$id)->first();
    $address = Address::where('driver_id',$id)->first();
    return view($this->view .'edit')->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones)
    ->with('driver',$driver)->with('address',$address);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {
   
    $driver = Driver::where('id',$id)->first();
     $password = $driver->password;
     $request->validate(['phone' => "required|unique:drivers,phone,$id"]);
    // $driver = $driver->update($request->all());
     $driver = Driver::where('id',$id)->first();
    if($request->password){
    $driver->password = Hash::make($request->password);}else{
         $driver->password = $password;
         $driver->save();
    }
       $driver->update([
        "name" => $request->name,
         "phone" => $request->phone,
          "mobile" => $request->mobile,
 
           ]);
    

        $address =  Address::where('driver_id',$id)->first();
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
         $address->street = $request->street;
         $address->driver_id = $driver->id;
         $address->save();

          return redirect()->route($this->route."index")
        ->with(['success'=> "تم التعديل بنجاح"]);

  }


  public function destroy($id)
  {
     $driver = Driver::where('id',$id)->first();
      $driver->delete();
      return response()->json(['status' => true]);
  }
 
}

?>