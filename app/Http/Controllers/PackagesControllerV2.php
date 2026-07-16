<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Package;
use App\Models\CountryPackage;
use App\Models\PackageCategory;
use App\DataTables\PackageDataTableV2;

class PackagesControllerV2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PackageDataTableV2 $dataTable)
    {
        return $dataTable->render('dashboard.packagesV2.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::all();
        $categories = PackageCategory::all();
        return view('dashboard.packagesV2.create')->with('countries',$countries)->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $package = new Package;
        $package->name = $request->name;
        $package->packagecategory_id = $request->packagecategory_id;
        $package->showdays = $request->showdays;
        // $package->orders_number = $request->orders_number;
        // $package->branches_number = $request->branches_number;
        // $package->items_number = $request->items_number;
        // $package->notifications_number = $request->notifications_number;
        $package->save();
        foreach($request->country_id as $key => $country){
            $cp = new CountryPackage;
            $cp->package_id = $package->id;
            $cp->country_id = $country;
            $cp->price = $request->price[$key];;
            $cp->save();
        }
        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        $package = Package::where('id',$id)->first();
        $categories = PackageCategory::all();
        return view('dashboard.packagesV2.edit')->with('countries',$countries)->with('package',$package)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $package = Package::where('id',$id)->first();
        $package->name = $request->name;
        $package->packagecategory_id = $request->packagecategory_id;
        $package->showdays = $request->showdays;
        // $package->items_number = $request->items_number;
        // $package->notifications_number = $request->notifications_number;
        $package->save();
        if($request->country_id){
            CountryPackage::where('package_id',$package->id)->delete();
  
            foreach($request->country_id as $key => $country){
                $cp = new CountryPackage;
                $cp->package_id = $package->id;
                $cp->country_id = $country;
                $cp->price = $request->price[$key];;
                $cp->save();
            }
        }
        return redirect()->route('packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $package = Package::where('id',$id)->first();
        $package->delete();
        return response()->json(['status' => true]);
    }
}
