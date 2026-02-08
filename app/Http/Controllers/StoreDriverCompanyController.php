<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicletypes;
use App\Models\Gender;
use App\Models\Statussocial;
use App\Models\Armycase;
use App\Models\ExpenseDriver;
use App\Models\Expense;
use App\Models\AllCollection;
use App\Models\Income;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\traits\generaltrait;
use App\Models\DriverContract;
use App\Http\Resources\DriverResource;
use App\DataTables\CompanyDriversDataTable;

use App\Models\Address;
use App\Models\Driver;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\Events\DriverMoved;
use App\Events\GetOrder;
class StoreDriverCompanyController extends Controller 
{
use generaltrait;
  /**use generaltrait;
   * Display a listing of the resource.
   *
   * @return Response
   */
 
  public function index(CompanyDriversDataTable $dataTable,$id)
    {
    $dataTable->id = $id;
        return $dataTable->render('admindashboard.driver_companies.drivers.index',['id' => $id]);
    
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create($id)
  {

    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
    return view('admindashboard.driver_companies.drivers.create')->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones)->with('id',$id);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request,$id)
  {
     $request->validate(['phone' => 'required|unique:drivers']);
    $driver = Driver::create([
        "name" => $request->name,
         "phone" => $request->phone,
          "mobile" => $request->mobile,
       //   "least_price" => $request->least_price,
       //    "commission" => $request->commission,
           "driver_id" => $id,
           "is_company" => 0,
      "password" =>  Hash::make($request->phone)
        ]);
    //  if($request->hasFile('image'))
    //     {
       
    //         $image = $this->uploadimage($request->image,'drivers');
    //         $driver->image = $image;
    //     } if($request->hasFile('identification_number_image'))
    //     {
       
    //         $image = $this->uploadimage($request->identification_number_image,'drivers');
    //         $driver->identification_number_image = $image;
    //     } if($request->hasFile('residence_deed_image'))
    //     {
       
    //         $image = $this->uploadimage($request->residence_deed_image,'drivers');
    //         $driver->residence_deed_image = $image;
    //     }if($request->hasFile('vehicle_license_image'))
    //     {
       
    //         $image = $this->uploadimage($request->vehicle_license_image,'drivers');
    //         $driver->vehicle_license_image = $image;
    //     } if($request->hasFile('license_image'))
    //     {
       
    //         $image = $this->uploadimage($request->license_image,'drivers');
    //         $driver->license_image = $image;
    //     }
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
         $address->save();
        //  $contract = new DriverContract;
        //  $contract->from_day = $request->from_day;
        //   $contract->to_day = $request->to_day;

        //  $contract->sallary = $request->sallary;
        //  $contract->notes = $request->notes;
        //  if($request->hasFile('paper_contract_image'))
        // {
       
        //     $image = $this->uploadimage($request->paper_contract_image,'contracts');
        //     $contract->paper_contract_image = $image;
        // }    $contract->driver_id = $driver->id;
        // $contract->save();
        return redirect()->route('company_drivers.index',["id" => $id]);

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(DriverordersDataTable $dataTable,$id)
  {
    $driver = Driver::where('id',$id)->first();
     $dataTable->id = $id;
     $contract = DriverContract::where('driver_id',$id)->where("active",1)->latest()->first();
     return $dataTable->render('admindashboard.drivers.show',['driver' => $driver,'contract' => $contract]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
  
    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
      $driver = Driver::where('id',$id)->first();
    $address = Address::where('driver_id',$id)->first();
    $contract = DriverContract::where('driver_id',$id)->first();
    return view('admindashboard.driver_companies.drivers.edit')->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones)
    ->with('driver',$driver)->with('address',$address)->with('contract',$contract);
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
         // "least_price" => $request->least_price,
          // "commission" => $request->commission
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
    //      $contract =  DriverContract::where('driver_id',$id)->first();
    //      $contract->from_day = $request->from_day;
    //       $contract->to_day = $request->to_day;

    //      $contract->sallary = $request->sallary;
    //      $contract->notes = $request->notes;
    //      if($request->hasFile('paper_contract_image'))
    //     {
    //   File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
    //         $image = $this->uploadimage($request->paper_contract_image,'contracts');
    //         $contract->paper_contract_image = $image;
    //     }    $contract->driver_id = $driver->id;
    //     $contract->save();
        return redirect()->route('company_drivers.index',["id" => $driver->driver_id]);

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $driver = Driver::where('id',$id)->first();
      $driver->delete();
      return response()->json(['status' => true]);
  }
 
}

?>