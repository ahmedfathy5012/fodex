<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller 
{
    public function areas_report(){

        return view('admindashboard.reports.areas_report');
    }
}