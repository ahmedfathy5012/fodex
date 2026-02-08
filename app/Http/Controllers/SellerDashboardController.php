<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Item;
class SellerDashboardController extends Controller
{
    public function index(){
        $items = Item::where("seller_id",auth()->id())->get();
        $orders = Order::get();
        return view("sellerdashboard.mainpage.index",compact("items","orders"));
    }public function mostmyitemsorder(){
        $items = Item::where("seller_id",auth()->id())->get()->sortByDesc("count_number")->take('10');
        $names =[];
   $numbers=[];
   foreach($items as $item){
       $names[]= $item->title;
       $numbers[]=$item->count_number;
   }return response()->json(["status" => true,
   "data"=>[
       'names'=> $names,'numbers' => $numbers]]);
    }
}