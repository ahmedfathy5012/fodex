<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\SellerZone;
use App\Models\Country;
use App\Models\City;
use App\Models\Zone;
use App\DataTables\SellerZoneDataTable;
use App\Models\Seller;
use Illuminate\Validation\Rule;

class SellerZoneController extends Controller 
{

  
      public function index(SellerZoneDataTable $dataTable,$id)
    {
      // dd(Country::all());
      $dataTable->id = $id;
        return $dataTable->render('admindashboard.sellers.zones.index',['id' =>$id]);
    
  }

 
  public function create($id)
  {
        $seller = Seller::where("id",$id)->first();
        $country_id = $seller->address->country_id ?? "";
        $zones = Zone::where("country_id",$country_id)->get();
    return view('admindashboard.sellers.zones.create',compact("zones","id"));
  }

  
  public function store(Request $request,$id)
  {
       $request->validate([
            'zone_id' => Rule::unique('seller_zones')->where(function ($query) use ($id) {
                return $query->where('seller_id', $id);
            }),//"required|unique:drivers",//phone,$store_id,store_id",
            
        ],["zone_id.unique" => "هذه المنطقه موجود من قبل"]);
    $sellerzone = new SellerZone;
    $sellerzone->delivery_money = $request->delivery_money;
    $sellerzone->zone_id = $request->zone_id;
    $sellerzone->seller_id = $id;
    $sellerzone->save();
  
    return redirect()->route('sellerzones',['id' => $id]);
  }
  public function edit($id)
  {
       $sellerzone = SellerZone::where("id",$id)->first();
        $seller = Seller::where("id",$sellerzone->seller_id)->first();
        $country_id = $seller->address->country_id ?? "";
        $zones = Zone::where("country_id",$country_id)->get();
    return view('admindashboard.sellers.zones.edit',compact("sellerzone","zones"));
  }
  public function update($id,Request $request)
  {
         $sellerzone = SellerZone::where("id",$id)->first();
         $seller_id = $sellerzone->seller_id;
      $request->validate([
            'zone_id' => Rule::unique('seller_zones')->ignore($id, 'id')->where(function ($query) use ($seller_id) {
                return $query->where('seller_id', $seller_id);
            }),//"required|unique:drivers",//phone,$store_id,store_id",
            
        ],["zone_id.unique" => "هذه المنطقه موجود من قبل"]);
   $sellerzone = SellerZone::where("id",$id)->first();
    $sellerzone->delivery_money = $request->delivery_money;
    $sellerzone->zone_id = $request->zone_id;
    $sellerzone->save();
  
    return redirect()->route('sellerzones',['id' => $sellerzone->seller_id]);
  }

  public function destroy($id)
  {
   $sellerzone = SellerZone::where("id",$id)->first();
    $sellerzone->delete();
    return response()->json(['status' => true]);
  }
  
}

?>