<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ZoneOrderDataTable;
use App\Models\Zone;
class ZoneOrderController extends Controller 
{
    public function index(ZoneOrderDataTable $dataTable)
    {
      $zones = Zone::all();
        return $dataTable->render('admindashboard.reports.zone_orders.orders',['zones' => $zones]);
    
  }
}