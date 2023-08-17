<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use App\Models\Seller;
use App\Models\Coupon;
use App\DataTables\CouponDataTable;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponDataTable $dataTable)
    {
     return  $dataTable->render("admindashboard.coupons.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      
          $cities = City::where("country_id",auth()->user()->countries->pluck("id")->toArray())->get();
           $sellers = Seller::all();
           
        return view("admindashboard.coupons.create",compact("cities","sellers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      $data =  $request->validate([
            'value' => 'sometimes',
            'name' => 'required',
            'percentage' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'usage_number' => 'required',
            'minmum_price' => 'required',
             'general' => 'sometimes',
               'title' => 'required',
            'description' => 'sometimes',
             'delivery_fee' => 'sometimes'
            ],[
            'required' => 'هذا الحقل مطلوب'    
                ]);
        $coupon = Coupon::create($data);
        if(!$request->general){
        // if($request->country_id){
        //     $coupon->countries()->attach($request->country_id);
        // }  
        // if($request->state_id){
        //      $coupon->states()->attach($request->state_id);
        // } 
        if($request->city_id){
             $coupon->cities()->attach($request->city_id);
        } 
        // if($request->zone_id){
        //      $coupon->zones()->attach($request->zone_id);
        // } 
        if($request->seller_id){
             $coupon->sellers()->attach($request->seller_id);
        }
        }
           return redirect()->route("coupons.index");
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
   $cities = City::where("country_id",auth()->user()->countries->pluck("id")->toArray())->get();
           $sellers = Seller::all();
            $coupon = Coupon::where('id',$id)->first();
        return view("admindashboard.coupons.edit",compact("cities","sellers","coupon"));
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
       $data =  $request->validate([
            'value' => 'sometimes',
            'name' => 'required',
            'percentage' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'usage_number' => 'required',
            'minmum_price' => 'required',
            'general' => 'sometimes',
            'title' => 'required',
            'description' => 'sometimes',
            'delivery_fee' => 'sometimes'
            ],[
            'required' => 'هذا الحقل مطلوب'    
                ]);
         $coupon = Coupon::where('id',$id)->first();
         $coupon->update($data);
         $coupon->delivery_fee = $request->delivery_fee ? 1 : 0; 
           $coupon->general = $request->general ? 1 : 0; 
           $coupon->save();
           if(!$request->general){
         if($request->city_id){
             $coupon->cities()->sync($request->city_id);
        } if($request->seller_id){
             $coupon->sellers()->sync($request->seller_id);
        }
           }else{
          $coupon->cities()->sync([]);
        
             $coupon->sellers()->sync([]);
           }
        return redirect()->route("coupons.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $coupon = Coupon::where('id',$id)->first();
       $coupon->delete();
       return response()->json(['status' => true]);
    }
}
