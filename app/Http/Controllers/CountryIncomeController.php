<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CountryOrderDataTable;
use App\Models\Country;
use App\Models\Major;
use App\Models\Order;
class CountryIncomeController extends Controller
{
    private function reportView(string $page):string
    {
         return env('APP_ENV') == 'production'
              ? "admindashboard.reports.country_incomes.$page"
              : "admindashboard.reports.country_incomes.V2.$page";
    }
    public function index()
    {
   $countries = Country::all();
   $majors = Major::all();
    $orders = Order::where("status",3)->get();
    $total = array_sum($orders->pluck("priceafterdiscount")->toArray());
    $seller_commission = array_sum($orders->pluck("money_seller_commission")->toArray());
    $driver_commission = array_sum($orders->pluck("delivery_commission")->toArray()) - array_sum($orders->pluck("money_seller_commission")->toArray());
    $order_count = count($orders);
        return view($this->reportView('index'),compact("countries","majors","total","seller_commission","driver_commission","order_count"));

  }public function filtercountry_icomes(Request $request){
       $countries = Country::all();

    $orders = Order::where("status",3)->where(function ($query) use ($request) {
                $query->when($request->country_id != 0,function($q) use($request){

                    return $q->where("country_id",$request->country_id);
                });
                $query->when($request->major_id != 0,function($q) use($request){
                    return $q->whereHas("seller", function ($qq) use ($request) {
                        return $qq->where("major_id", $request->major_id);
                    });
                });
                $query->when($request->datepicker,function($q) use($request){

                    $from = explode(" - ",$request->get('datepicker'))[0];
                    $to = explode(" - ",$request->get('datepicker'))[1];
                    return $q->whereBetween('created_at',[$from,$to]);
                });
                })->get();
    $total = array_sum($orders->pluck("priceafterdiscount")->toArray());
    $seller_commission = array_sum($orders->pluck("money_seller_commission")->toArray());
    $driver_commission = array_sum($orders->pluck("delivery_commission")->toArray()) - array_sum($orders->pluck("money_seller_commission")->toArray());
      $order_count = count($orders);
     return response()->json(['status' => true,"total" => $total,"seller_commission" => $seller_commission,
     "driver_commission" =>$driver_commission,"order_count" => $order_count]);
  }
}
