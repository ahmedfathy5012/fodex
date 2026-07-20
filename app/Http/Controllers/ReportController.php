<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function reportView(string $page):string
    {
         return env('APP_ENV') == 'production'
              ? "admindashboard.reports.zone_orders.$page"
              : "admindashboard.reports.zone_orders.V2.$page";
    }
    public function areas_report(){

        return view($this->reportView('areas_report'));
    }

//    public function areas_report(){
//
//        return view('admindashboard.reports.zone_orders.V2.areas_report');
//    }


}
