<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Order;
use App\DataTables\MajorMoneyDataTable;
class MajorIncomeController extends Controller 
{
    public function index(MajorMoneyDataTable $dataTable)
    {
//   $majors = Major::all();
//     $orders = Order::where("status",3)->get();
//     $total = array_sum($orders->pluck("priceafterdiscount")->toArray());
//     $seller_commission = array_sum($orders->pluck("money_seller_commission")->toArray());
//     $driver_commission = array_sum($orders->pluck("delivery_commission")->toArray()) - array_sum($orders->pluck("money_seller_commission")->toArray());
//     $order_count = count($orders);
//         return view('admindashboard.major_reports.index',compact("majors","total","seller_commission","driver_commission","order_count"));
        return $dataTable->render('admindashboard.major_reports.major_money');

    
  }public function filtermajor_incomes(Request $request){
       
       
    $orders = Order::where("status",3)->whereHas('seller',function ($query) use ($request) {
                $query->when($request->major_id != 0,function($q) use($request){
                   
                    return $q->where("major_id",$request->major_id);
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