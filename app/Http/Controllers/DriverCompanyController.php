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
use App\DataTables\DriverCompanyDataTable;
use App\DataTables\CompanyCollectionDataTable;
use App\Models\Address;
use App\Models\Driver;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\Events\DriverMoved;
use App\Events\GetOrder;
class DriverCompanyController extends Controller 
{
use generaltrait;
  /**use generaltrait;
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(DriverCompanyDataTable $dataTable)
    {
        $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.driver_companies.index',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
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
    $vtypes = Vehicletypes::All();
    return view('admindashboard.driver_companies.create')->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones)->with('vtypes',$vtypes);
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
      "password" =>  Hash::make($request->phone),
      'is_company' => 1,
      'master' => $request->master ? 1 :0,
        "commission" => $request->commission
        ]);
        $driver->zones()->attach($request->zone_ids);
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
        return redirect()->route('driver_companies.index');

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
     return $dataTable->render('admindashboard.driver_companies.show',['driver' => $driver,'contract' => $contract]);
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
    return view('admindashboard.driver_companies.edit')->with('countries',$countries)->with('states',$states)->with('cities',$cities)->with('zones',$zones)
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
     $driver = Driver::where('id',$id)->first();
    if($request->password){
    $driver->password = Hash::make($request->password);}else{
         $driver->password = $password;
    }
     
    $driver->save();
        $driver->update([
        "name" => $request->name,
         "phone" => $request->phone,
          "mobile" => $request->mobile,
         'master' => $request->master ? 1 :0,
          "commission" => $request->commission
           ]);
       $driver->zones()->sync($request->zone_ids);
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
        return redirect()->route('driver_companies.index');

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
  public function company_collections(CompanyCollectionDataTable $dataTable)
    {
        return $dataTable->render('admindashboard.driver_companies.notcollectdrivers');
    
  }public function add_company_collection(Request $request){
      $res = Driver::where('id',$request->id)->first();
    $collect = AllCollection::where('driver_id',$request->id)->where('month_date',$request->date)
        ->first();
        if($collect){
            $collect->money_left = $collect->total -($collect->money_taken + $request->value);
            $collect->money_taken = $collect->money_taken + $request->value;
           $collect->save();
            return response()->json(['status' => true,'message' => 'تم التحصيل بنجاح']);
        }else{
        //     dd($request->all());
            $orders = $res->company_done_orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($request->date))
      ->whereMonth('orders.created_at',\Carbon\Carbon::parse($request->date))->get();
    //   ->whereMonth('orders.created_at',$date3)->get();

    //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
    //   ->whereMonth('orders.created_at',$date3)->get();
       $countorders = count($orders); 
            $money =
        array_sum($res->orders()->whereYear('orders.created_at',\Carbon\Carbon::parse($request->date))
        ->whereMonth('orders.created_at',\Carbon\Carbon::parse($request->date))->get()->pluck('delivery_fee')->toArray());
     //  $contract =  Sellercontract::where('seller_id',$request->id)->where('active',1)->latest()->first();
        
       
          $value = $money * ($res->commission /100);
           $collect = new AllCollection;
        $collect->seller_id = $request->id;
        $collect->total = $value;
        $collect->ordersnumber = $countorders;
        $collect->money_taken = $request->value;
        $collect->month_date = $request->date;
        $collect->money_left = $value -  $request->value;
        $collect->save();
        return response()->json(['status' => true,'message' => 'تم التحصيل بنجاح']);
        }
    }
}

