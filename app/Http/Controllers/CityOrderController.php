<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CityOrderDataTable;
use App\Models\City;
class CityOrderController extends Controller 
{
    public function index(CityOrderDataTable $dataTable)
    {
       $cities = City::all();
        return $dataTable->render('admindashboard.reports.city_orders.orders',['cities' => $cities]);
    
  }
}