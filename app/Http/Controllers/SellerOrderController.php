<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\Zone;
use App\DataTables\OrderDataTable;
use App\DataTables\Orderitem2DataTable;
use App\Models\Order;
use App\DataTables\SellerOrder2DataTable;
use App\DataTables\DriverordersDataTable;
class SellerOrderController extends Controller
{
     public function myorders(SellerOrder2DataTable $dataTable)
    {
        return $dataTable->render('sellerdashboard.orders.orders');
  }public function showmyorders(Orderitem2DataTable $dataTable,$id)
    {
        $dataTable->id = $id;
        $order = Order::where('id',$id)->first();
          return $dataTable->render('sellerdashboard.orders.orderitems',['order' => $order]);
    }
}