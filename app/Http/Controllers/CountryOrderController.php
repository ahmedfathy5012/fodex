<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CountryOrderDataTable;
use App\Models\Country;
class CountryOrderController extends Controller 
{
    public function index(CountryOrderDataTable $dataTable)
    {
   $countries = Country::all();
        return $dataTable->render('admindashboard.reports.country_orders.orders',['countries' => $countries]);
    
  }
}