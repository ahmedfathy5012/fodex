<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\DataTables\SellerMoneyDataTable;
use App\Models\Major;

class SellerMoneyController extends Controller 
{

  
   public function index(SellerMoneyDataTable $dataTable)
    {
        $majors = Major::all();

        return $dataTable->render('admindashboard.seller_money.index', compact('majors'));
    }
}
