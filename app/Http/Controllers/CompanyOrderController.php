<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\traits\generaltrait;
use App\DataTables\CompanyOrderDataTable;
use Illuminate\Support\Facades\File;

class CompanyOrderController extends Controller
{
    use generaltrait;

    private function companyOrderView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.driver_companies.orders.$page"
            : "admindashboard.driver_companies.orders.V2.$page";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CompanyOrderDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->companyOrderView('index'));
    }
}
