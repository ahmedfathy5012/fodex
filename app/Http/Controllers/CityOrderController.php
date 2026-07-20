<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CityOrderDataTable;
use App\Models\City;
class CityOrderController extends Controller
{
    private function reportView(string $page):string
    {
         return env('APP_ENV') == 'production'
              ? "admindashboard.reports.city_orders.$page"
              : "admindashboard.reports.city_orders.V2.$page";
    }
    public function index(CityOrderDataTable $dataTable)
    {
       $cities = City::all();
        return $dataTable->render($this->reportView('orders'),['cities' => $cities]);

  }
}
