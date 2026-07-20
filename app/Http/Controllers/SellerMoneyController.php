<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\DataTables\SellerMoneyDataTable;
use App\Models\Major;

class SellerMoneyController extends Controller
{
    private function sellerMoney(string $page): string
    {
        return env("APP_ENV") == "production"
            ? "admindashboard.seller_money.$page"
            : "admindashboard.seller_money.V2.$page";
    }


    public function index(SellerMoneyDataTable $dataTable)
    {
        $majors = Major::all();

        return $dataTable->render($this->sellerMoney('index'), compact('majors'));
    }
}
