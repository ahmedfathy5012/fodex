<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Tag;
use App\Models\State;
use App\Models\Zone;
use App\Models\Major;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Armycase;
use App\traits\generaltrait;
use App\Models\Sellercontract;
use App\DataTables\SellerDataTable;
use App\DataTables\Seller3DataTable;
use App\DataTables\OrderItemSellerDataTable;
use App\DataTables\SellercontractDataTable;
use App\Models\Address;
use App\Models\AllCollection;
use App\Models\Sellerimage;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\Models\NumberSetting;
use App\Models\Payment;
use App\Models\SellerEmployee;
use App\Models\WebsiteSeller;
class SellerController extends Controller 
{
use generaltrait;
  
   public function index(SellerDataTable $dataTable)
    {
         $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.sellers.index',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
     $armycases = Armycase::all();

    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
    $majors= Major::all();
    $tags = Tag::all();
     $payments = Payment::all();
    $number = NumberSetting::first();
    $categories = Category::all();
    return view('admindashboard.sellers.create')->with('countries',$countries)->with('tags',$tags)->with('number',$number)->
    with('states',$states)->with('cities',$cities)->with('zones',$zones)->with('majors',$majors)->
    with('categories',$categories)->with('payments',$payments);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

     $request->validate(['phone' => 'required|unique:sellers']);
    $seller = Seller::create($request->all());
    $seller->password = Hash::make($request->password);
    $seller->discount = $request->discount;
    $seller->delivery_money = $request->delivery_money;
     $seller->min_order = $request->min_order;
    $seller->is_new = $request->is_new ? 1 : 0;

    $seller->agreed = $request->agreed  ? 1 : 0;
    $seller->is_subcategory = $request->is_subcategory;
         if($request->hasFile('cover'))
        {
            $image = $this->uploadimage($request->cover,'sellers');
            $seller->cover = $image;
        }       if($request->hasFile('logo'))
        {
     
            $image = $this->uploadimage($request->logo,'sellers');
            $seller->logo = $image;
        } 
    $seller->save();
     if($request->image)
        {
            foreach($request->image as $image){
            $sellerimage = new Sellerimage;
            $newimage = $this->uploadimage($image,'sellers');
            $sellerimage->image = $newimage;
            $sellerimage->seller_id = $seller->id;
            $seller->save();
          }
        }
          $major = Major::where('id',$request->major_id)->first();
  
        $seller->categories()->attach($major->categories()->pluck('id')->toArray());
       
        if($request->tag_id){
        $seller->tags()->attach($request->tag_id);}
        
        if($request->payment_id){
        $seller->payments()->attach($request->payment_id);}
        $address = new Address;
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        // $address->floor_number = $request->floor_number;
        // $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
         $address->street = $request->street;
           $address->address = $request->address;
         $address->seller_id = $seller->id;
         $address->save();
          $employee = new SellerEmployee;
          $employee->name = $request->name;
          $employee->phone = $request->phone;
    $employee->password = Hash::make($request->phone);
   $employee->seller_id = $seller->id;
   $employee->save();
        //  $contract = new Sellercontract;
        //  $contract->from_day = $request->from_day;
        //   $contract->to_day = $request->to_day;

        //  $contract->percentage = $request->percentage;
        //  $contract->notes = $request->notes;
        //  if($request->hasFile('paper_contract_image'))
        // {
       
        //     $image = $this->uploadimage($request->paper_contract_image,'contracts');
        //     $contract->paper_contract_image = $image;
        // }  
        //  $contract->seller_id = $seller->id; 
        // $contract->save();
        return redirect()->route('seller.index');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(SellercontractDataTable $dataTable,$id)
  {
      $seller = Seller::where('id',$id)->first();
     $dataTable->id = $id;
     return $dataTable->render('admindashboard.sellers.show',['seller' => $seller]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      $armycases = Armycase::all();

    $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
    $majors= Major::all();
     $tags= Tag::all();
      $payments = Payment::all();
    $categories = Category::all();
      $seller = Seller::where('id',$id)->first();
    $address = Address::where('seller_id',$id)->first();
    $contract = Sellercontract::where('seller_id',$id)->first();
    return view('admindashboard.sellers.edit')->with('countries',$countries)->with('tags',$tags)
    ->with('states',$states)->with('cities',$cities)->with('zones',$zones)->with('majors',$majors)
    ->with('categories',$categories)->with('seller',$seller)->with('address',$address)->with('contract',$contract)
    ->with('payments',$payments);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request,$id)
  {

      $major = Major::where('id',$request->major_id)->first();
       $seller = Seller::where('id',$id)->first();
     $password = $seller->password;
     $request->validate(['phone' => "required|unique:sellers,phone,$id"]);
    $seller = $seller->update($request->all());
     $seller = Seller::where('id',$id)->first();
    if($request->password){
    $seller->password = Hash::make($request->password);}else{
         $seller->password = $password;
    }
     $seller->discount = $request->discount;
     $seller->is_subcategory = $request->is_subcategory;
    $seller->delivery_money = $request->delivery_money;
    $seller->min_order = $request->min_order;
    $seller->is_new = $request->is_new ? 1 : 0;

    $seller->agreed = $request->agreed  ? 1 : 0;
    $seller->save();
            if($request->hasFile('cover'))
        {
       File::delete(public_path(). '/uploads/'.$seller->cover);
            $image = $this->uploadimage($request->cover,'sellers');
            $seller->cover = $image;
        }       if($request->hasFile('logo'))
        {
       File::delete(public_path(). '/uploads/'.$seller->logo);
            $image = $this->uploadimage($request->logo,'sellers');
            $seller->logo = $image;
        } 
    $seller->save();
    if($request->image)
        {
          if(count($seller->images) > 0){
          foreach($seller->images as $im){
             File::delete(public_path(). '/uploads/'.$im->image);
          }
        }
            foreach($request->image as $image){

            $sellerimage = new Sellerimage;
            $newimage = $this->uploadimage($image,'sellers');
            $sellerimage->image = $newimage;
            $sellerimage->seller_id = $seller->id;
            $sellerimage->save();
          }
        }
        $seller->categories()->sync($major->categories()->pluck('id')->toArray());
         $seller->tags()->sync($request->tag_id);
            if($request->payment_id){
        $seller->payments()->sync($request->payment_id);}
        $address =  Address::where('seller_id',$seller->id)->firstOrNew();
        $address->country_id = $request->country_id;
        $address->state_id = $request->state_id;
        $address->city_id = $request->city_id;
        $address->zone_id = $request->zone_id;
        $address->floor_number = $request->floor_number;
        $address->building_number = $request->building_number;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
          $address->address = $request->address;
         $address->street = $request->street;
         $address->seller_id = $seller->id;
         $address->save();
    //      $contract =  Sellercontract::where('seller_id',$seller->id)->first();
    //      $contract->from_day = $request->from_day;
    //       $contract->to_day = $request->to_day;

    //      $contract->percentage = $request->percentage;
    //      $contract->notes = $request->notes;
    //      if($request->hasFile('paper_contract_image'))
    //     {
    //   File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
    //         $image = $this->uploadimage($request->paper_contract_image,'contracts');
    //         $contract->paper_contract_image = $image;
    //     }  
    //      $contract->seller_id = $seller->id; 
    //     $contract->save();
        return redirect()->route('seller.index');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      $seller = Seller::where('id',$id)->first();
        if(count($seller->images) > 0){
          foreach($seller->images as $im){
             File::delete(public_path(). '/uploads/'.$im->image);
          }
        }
        $seller->address()->delete();
      $seller->delete();
      return response()->json(['status' => true]);
  }public function blockseller(Request $request){
      $seller = Seller::where('id',$request->id)->first();
      if($seller->block == 1){
          $seller->block = 0;
          $seller->save();
      }else{
           $seller->block = 1;
           $seller->block_reason = $request->block_reason;
          $seller->save();
      }
      return response()->json(['status' => true]);
  }
  
public function openseller($id){
       $seller = Seller::where('id',$id)->first();
          
          $seller->availability = !$seller->availability;
          $seller->save();
              return response()->json(['status' => true]);
      
}    public function sellercontracts(SellercontractDataTable $dataTable,$id){
     $dataTable->id = $id;
     return $dataTable->render('admindashboard.sellers.contracts',['id' => $id]);
}public function addsellercontract($id){
    return view('admindashboard.sellers.addsellercontract')->with('id',$id);
}public function storesellercontract(Request $request,$id){
    Sellercontract::where('seller_id',$id)->update(['active' => 0]);
    $contract = new Sellercontract;
         $contract->from_day = $request->from_day;
          $contract->to_day = $request->to_day;

         $contract->percentage = $request->percentage;
         $contract->notes = $request->notes;
         if($request->hasFile('paper_contract_image'))
        {
       
            $image = $this->uploadimage($request->paper_contract_image,'contracts');
            $contract->paper_contract_image = $image;
        }  
         $contract->seller_id = $id; 
         $contract->active = 1;
        $contract->save();
        return redirect('sellercontracts/'.$id);
}public function editsellercontract($id){
    $contract =  Sellercontract::where('id',$id)->first();
    return view('admindashboard.sellers.editsellercontract')->with('contract',$contract);
}public function updatesellercontract(Request $request,$id){
    $contract =  Sellercontract::where('id',$id)->first();
         $contract->from_day = $request->from_day;
          $contract->to_day = $request->to_day;

         $contract->percentage = $request->percentage;
         $contract->notes = $request->notes;
         if($request->hasFile('paper_contract_image'))
        {
         File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
            $image = $this->uploadimage($request->paper_contract_image,'contracts');
            $contract->paper_contract_image = $image;
        }  
          
        $contract->save();
        
        return redirect('sellercontracts/'.$contract->seller_id);
}  public function deletesellercontract($id)
  {
        $contract =  Sellercontract::where('id',$id)->first();
           File::delete(public_path(). '/uploads/'.$contract->paper_contract_image);
      $contract->delete();
      return response()->json(['status' => true]);
  }public function activesellercontract($id){
        $contract =  Sellercontract::where('id',$id)->first();
        if($contract->active == 1){
            $contract->active = 0;
            $contract->save();
            return response()->json(['status' => true,'message' => 'تم الغاء التفعيل']);
        }   elseif($contract->active == 0){
            $contract->active = 1;
            $contract->save();
            return response()->json(['status' => true,'message' => 'تم  التفعيل']);
        }
  }public function addcollection(Request $request){
      $res = Seller::where('id',$request->id)->first();
    $collect = AllCollection::where('seller_id',$request->id)->where('month_date',$request->date)
        ->first();
        if($collect){
            $collect->money_left = $collect->total -($collect->money_taken + $request->value);
            $collect->money_taken = $collect->money_taken + $request->value;
           $collect->save();
            return response()->json(['status' => true,'message' => 'تم التحصيل بنجاح']);
        }else{
        //     dd($request->all());
            $orders = $res->acceptorders()->whereYear('orders.created_at',\Carbon\Carbon::parse($request->date))
      ->whereMonth('orders.created_at',\Carbon\Carbon::parse($request->date))->get();
    //   ->whereMonth('orders.created_at',$date3)->get();

    //   ->where('order_status_id',7)->whereYear('orders.created_at',$date3)
    //   ->whereMonth('orders.created_at',$date3)->get();
       $countorders = count($orders); 
            $money =array_sum($res->orders()->where('status',1)->whereYear('orders.created_at',\Carbon\Carbon::parse($request->date))
            ->whereMonth('orders.created_at',\Carbon\Carbon::parse($request->date))->get()->pluck('priceafterdiscount')->toArray()) -
        array_sum($res->orders()->where('status',1)->whereYear('orders.created_at',\Carbon\Carbon::parse($request->date))
        ->whereMonth('orders.created_at',\Carbon\Carbon::parse($request->date))->get()->pluck('delivery_fee')->toArray());
       $contract =  Sellercontract::where('seller_id',$request->id)->where('active',1)->latest()->first();
        
       
          $value = $money * ($contract->percentage /100);
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
    }  public function notcollectsellers(Seller3DataTable $dataTable)
    {
         $countries = Country::all();
    $states = State::all();
    $cities = City::all();
    $zones = Zone::all();
        return $dataTable->render('admindashboard.sellers.notcollectsellers',['countries' => $countries,'states' => $states,'cities' => $cities,'zones'=>$zones]);
    } public function orderitemseller(OrderItemSellerDataTable $dataTable,$id)
    {
    $dataTable->id = $id;
        return $dataTable->render('admindashboard.sellers.orderitemseller');
    }public function choose_seller_website($id){
       $seller = WebsiteSeller::where('seller_id',$id)->first();
       if($seller){
           $seller->delete();
       }else{
           WebsiteSeller::create([
               "seller_id" => $id]);
       }
              return response()->json(['status' => true]);
      
}
}
?>