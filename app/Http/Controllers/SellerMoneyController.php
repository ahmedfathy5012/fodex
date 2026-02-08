<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\DataTables\SellerMoneyDataTable;

class SellerMoneyController extends Controller 
{

  
   public function index(SellerMoneyDataTable $dataTable)
    {
        return $dataTable->render('admindashboard.seller_money.index');
    }
}