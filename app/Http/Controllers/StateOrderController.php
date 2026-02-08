<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\StateOrderDataTable;
use App\Models\State;
class StateOrderController extends Controller 
{
    public function index(StateOrderDataTable $dataTable)
    {
   $states = State::all();
        return $dataTable->render('admindashboard.reports.state_orders.orders',['states' => $states]);
    
  }
}