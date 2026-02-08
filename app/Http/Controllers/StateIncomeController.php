<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Order;
class StateIncomeController extends Controller 
{
    public function index()
    {
   $states = State::all();
    $orders = Order::where("status",3)->get();
    $total = array_sum($orders->pluck("priceafterdiscount")->toArray());
    $seller_commission = array_sum($orders->pluck("money_seller_commission")->toArray());
    $driver_commission = array_sum($orders->pluck("delivery_commission")->toArray()) - array_sum($orders->pluck("money_seller_commission")->toArray());
     $order_count = count($orders);
        return view('admindashboard.reports.state_incomes.index',compact("states","total","seller_commission","driver_commission","order_count"));
    
  }public function filterstate_icomes(Request $request){
       $states = State::all();
       
    $orders = Order::where("status",3)->where(function ($query) use ($request) {
                $query->when($request->state_id != 0,function($q) use($request){
                   
                    return $q->where("state_id",$request->state_id);
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
     "driver_commission" =>$driver_commission,'order_count' => $order_count]);
  }
}