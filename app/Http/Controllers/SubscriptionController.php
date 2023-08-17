<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Package;
use App\Models\CountryPackage;
use App\Models\SellerPackage;
use Carbon\Carbon;
use App\DataTables\SellerPackageDataTable;
class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SellerPackageDataTable $dataTable,$id)
    {
       $dataTable->id = $id;
        return $dataTable->render('admindashboard.subscriptions.index',['id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       $packages = Package::all();
       $seller = Seller::where('id',$id)->first();
       return view('admindashboard.subscriptions.create')->with('packages',$packages)->with('seller',$seller);
    }

    public function store(Request $request,$id)
    {
        $seller = Seller::where('id',$id)->first();
        $p = Package::where('id',$request->package_id)->first();
        $package = CountryPackage::where('package_id',$request->package_id)->where('country_id',$seller->country_id)->first();
        if($request->type == 30){
          $price = $package->month_price;
        }else if($request->type == 90){
            $price = $package->quarteryear_price;
        }else if($request->type == 180){
            $price = $package->halfyear_price;
        }else if($request->type == 365){
            $price = $package->year_price;
        }
       $sellerpackage = new SellerPackage;
       $sellerpackage->type = $request->type;
       $sellerpackage->package_id = $request->package_id;
       $sellerpackage->seller_id = $id;
       $sellerpackage->orders_number = $p->orders_number;
       $sellerpackage->branches_number = $p->branches_number;
       $sellerpackage->items_number = $p->items_number;
       $sellerpackage->notifications_number = $p->notifications_number;
       $sellerpackage->start_date = Carbon::now();
       $sellerpackage->end_date = Carbon::now()->addDays($request->type);
       $sellerpackage->price = $price;
       $sellerpackage->save();
       return redirect("subscriptions/".$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $packages = Package::all();
        $sellerpackage =  SellerPackage::where('id',$id)->first();
        $seller = Seller::where('id',$sellerpackage->seller_id)->first();
        return view('admindashboard.subscriptions.edit')->with('packages',$packages)
        ->with('sellerpackage',$sellerpackage)->with('seller',$seller);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sellerpackage =  SellerPackage::where('id',$id)->first();
        $seller = Seller::where('id',$sellerpackage->seller_id)->first();
        $p = Package::where('id',$request->package_id)->first();
        $package = CountryPackage::where('package_id',$request->package_id)->where('country_id',$seller->country_id)->first();
        if($request->type == 30){
          $price = $package->month_price;
        }else if($request->type == 90){
            $price = $package->quarteryear_price;
        }else if($request->type == 180){
            $price = $package->halfyear_price;
        }else if($request->type == 365){
            $price = $package->year_price;
        }
        
       $sellerpackage->type = $request->type;
       $sellerpackage->package_id = $request->package_id;
       $sellerpackage->orders_number = $p->orders_number;
       $sellerpackage->branches_number = $p->branches_number;
       $sellerpackage->items_number = $p->items_number;
       $sellerpackage->notifications_number = $p->notifications_number;
       $sellerpackage->start_date = Carbon::now();
       $sellerpackage->end_date = Carbon::now()->addDays($request->type);
       $sellerpackage->price = $price;
       $sellerpackage->save();
       return redirect("subscriptions/".$sellerpackage->seller_id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sellerpackage =  SellerPackage::where('id',$id)->first();
        $sellerpackage->delete();
        return response()->json(['status' => true]);
    }public function getpackage($id1,$id2){
        $seller = Seller::where('id',$id1)->first();
    
    $package = CountryPackage::where('package_id',$id2)->where('country_id',$seller->country_id)->first();
    return response()->json(['status' => true,'data' => $package]);
    }
}
