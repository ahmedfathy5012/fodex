<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CountryOrderDataTable;
use App\Models\Country;
class CountryOrderController extends Controller
{
    private function reportView(string $page):string
    {
         return env('APP_ENV') == 'production'
              ? "admindashboard.reports.country_orders.$page"
              : "admindashboard.reports.country_orders.V2.$page";
    }
    public function index(CountryOrderDataTable $dataTable)
    {
   $countries = Country::all();
        return $dataTable->render($this->reportView('orders'),['countries' => $countries]);

  }
}
