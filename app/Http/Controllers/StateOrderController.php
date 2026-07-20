<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\StateOrderDataTable;
use App\Models\State;
class StateOrderController extends Controller
{
    private function reportView(string $page):string
    {
         return env('APP_ENV') == 'production'
              ? "admindashboard.reports.state_orders.$page"
              : "admindashboard.reports.state_orders.V2.$page";
    }
    public function index(StateOrderDataTable $dataTable)
    {
   $states = State::all();
        return $dataTable->render($this->reportView('orders'),['states' => $states]);

  }
}
