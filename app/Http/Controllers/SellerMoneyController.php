<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\DataTables\SellerMoneyDataTable;
use App\Models\Category;

class SellerMoneyController extends Controller 
{

  
   public function index(SellerMoneyDataTable $dataTable)
    {
        $categories = Category::all();

        return $dataTable->render('admindashboard.seller_money.index', compact('categories'));
    }
}
