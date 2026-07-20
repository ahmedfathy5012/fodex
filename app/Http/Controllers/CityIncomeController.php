<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Major;
use App\Models\Order;
class CityIncomeController extends Controller
{
    private function reportView(string $page):string
    {
         return env('APP_ENV') == 'production'
              ? "admindashboard.reports.city_incomes.$page"
              : "admindashboard.reports.city_incomes.V2.$page";
    }
    public function index()
    {
   $cities = City::all();
   $majors = Major::all();
    $orders = Order::where("status",3)->get();
    $total = array_sum($orders->pluck("priceafterdiscount")->toArray());
    $seller_commission = array_sum($orders->pluck("money_seller_commission")->toArray());
    $driver_commission = array_sum($orders->pluck("delivery_commission")->toArray()) - array_sum($orders->pluck("money_seller_commission")->toArray());
    $order_count = count($orders);
        return view($this->reportView('index'),compact("cities","majors","total","seller_commission","driver_commission","order_count"));

  }public function filtercity_icomes(Request $request){
       $citys = city::all();

    $orders = Order::where("status",3)->where(function ($query) use ($request) {
                $query->when($request->city_id != 0,function($q) use($request){

                    return $q->where("city_id",$request->city_id);
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
                $order_count = count($orders);
    $total = array_sum($orders->pluck("priceafterdiscount")->toArray());
    $seller_commission = array_sum($orders->pluck("money_seller_commission")->toArray());
    $driver_commission = array_sum($orders->pluck("delivery_commission")->toArray()) - array_sum($orders->pluck("money_seller_commission")->toArray());
     return response()->json(['status' => true,"total" => $total,"seller_commission" => $seller_commission,
     "driver_commission" =>$driver_commission,'order_count' => $order_count]);
  }
}
