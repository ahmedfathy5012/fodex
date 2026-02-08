<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\DataTables\DriverMoneyDataTable;

class DriverMoneyController extends Controller 
{

  
   public function index(DriverMoneyDataTable $dataTable)
    {
        return $dataTable->render('admindashboard.driver_money.index');
    }
}