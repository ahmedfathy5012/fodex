<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\traits\generaltrait;
use App\DataTables\CompanyOrderDataTable;
use Illuminate\Support\Facades\File; 

class CompanyOrderController extends Controller 
{
use generaltrait;
  /**use generaltrait;
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function index(CompanyOrderDataTable $dataTable,$id)
    {
    $dataTable->id = $id;
        return $dataTable->render('admindashboard.driver_companies.orders.index');
    }
}